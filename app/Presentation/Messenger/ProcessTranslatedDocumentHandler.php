<?php declare(strict_types = 1);

namespace App\Presentation\Messenger;

use App\Application\Translation\Messenger\ProcessProductDocument;
use App\Application\Translation\TranslationFacade;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final readonly class ProcessTranslatedDocumentHandler implements MessageHandlerInterface
{
    public function __construct(
        private TranslationFacade $translationFacade,
    ) {
    }

    public function __invoke(ProcessProductDocument $productDocument): void
    {
        $this->translationFacade->processProductDocument($productDocument->id);
    }
}
