<?php declare(strict_types = 1);

namespace App\Application\Translation;

use App\Application\Translation\Messenger\CheckDocument;
use App\Application\Translation\Messenger\TranslateDocument;
use App\Domain\Translation\Client;
use App\Domain\Translation\ProductDocument;
use App\Domain\Translation\Repository\DocumentRepository;
use App\Domain\Translation\ResultAction;
use App\Domain\Translation\TranslatingDocument;
use App\Domain\Translation\TranslationBus;
use App\Domain\Translation\TranslationStatus;
use App\Domain\Product\Repository\ProductWebRepository;
use LogicException;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Tracy\ILogger;

final readonly class TranslationFacade
{
    public function processProductDocument(string $id): void
    {
        $productDocument = $this->documentRepository->getProductDocument($id);

        match ($productDocument->getResultAction()) {
            ResultAction::updateProperty => $productDocument->getTo()->setDescription($productDocument->getTranslatedContent()),
            ResultAction::none => null,
        };

        $this->productWebRepository->save($productDocument->getTo());
        $this->documentRepository->updateDocumentStatus($id, TranslationStatus::done);
    }

    public function __construct(
        private ILogger $logger,
        private DocumentRepository $documentRepository,
        private ProductWebRepository $productWebRepository,
        private TranslationBus $bus,
        private Client $client,
    ) {
    }

    public function addDocumentToQueue(ProductDocument $document): void
    {
        $documentId = $this->documentRepository->getNextId();
        $this->documentRepository->saveProductDocument($documentId, $document);
        $this->bus->dispatch(new TranslateDocument($documentId));
    }

    public function translate(string $id): void
    {
        $document = $this->documentRepository->getDocument($id);
        $translatingDocument = $this->client->translateDocument($id, $document);
        $this->documentRepository->updateDocument($id, $translatingDocument);

        $this->bus->dispatch(new CheckDocument($id));
    }

    public function checkDocument(string $id): void
    {
        $document = $this->documentRepository->getTranslatingDocument($id);
        $status = $this->client->checkStatus($document);
        $this->documentRepository->updateDocumentStatus($id, $status);

        match ($status) {
            TranslationStatus::new,
            TranslationStatus::translating,
            TranslationStatus::queued => $this->bus->dispatch((new Envelope(new CheckDocument($id)))->with(new DelayStamp(5 * 1000))),
            TranslationStatus::translated => $this->saveTranslatedDocument($document),
            TranslationStatus::error => $this->logNotTranslatedDocument($document),
            default => throw new LogicException(sprintf('Type "%s" does not supported ', $status->name)),
        };
    }

    private function saveTranslatedDocument(TranslatingDocument $document): void
    {
        $translatedDocument = $this->client->getResult($document);
        $this->documentRepository->updateTranslatingDocument($document->getTranslationDocumentId(), $translatedDocument);
        $this->bus->dispatch($document->getDocumentType()->getMessage($document->getTranslationDocumentId()));
    }

    private function logNotTranslatedDocument(TranslatingDocument $document): void
    {
        $this->logger->log(\sprintf('Client API returns error for document with ID %s. ', $document->getTranslationDocumentId()));
    }
}
