<?php declare(strict_types = 1);

namespace App\Domain\Translation;

use App\Domain\Product\Entity\ProductWeb;
use App\Domain\Shared\Lang\LangCode;

class ProductDocument implements Document, TranslatedDocument, ComparableWithSourceDocument
{
    private const IS_SIMILAR_PERCENTAGE = 95;

    private ProductWeb $from;

    private ProductWeb $to;

    private string $translatedContent;

    private int $documentId;

    final private function __construct(
        protected LangCode $fromLang,
        protected LangCode $toLang,
        protected DocumentType $documentType,
        protected ResultAction $resultAction,
        protected string $content,
    ) {
    }

    public function getFrom(): ProductWeb
    {
        return $this->from;
    }

    public function getTo(): ProductWeb
    {
        return $this->to;
    }

    public function isSame(): bool
    {
        $percentage = 0.0;
        \similar_text($this->from->getLongDescription() ?? '', $this->getContent(), $percentage);

        return $percentage > self::IS_SIMILAR_PERCENTAGE;
    }

    public function getFromLang(): LangCode
    {
        return $this->fromLang;
    }

    public function getToLang(): LangCode
    {
        return $this->toLang;
    }

    public function getDocumentType(): DocumentType
    {
        return $this->documentType;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getResultAction(): ResultAction
    {
        return $this->resultAction;
    }

    public function getTranslatedContent(): string
    {
        return $this->translatedContent;
    }

    public function getTranslationDocumentId(): int
    {
        return $this->documentDeepLId;
    }

    public static function createFromEntity(TranslationDocument $deepLDocument): self
    {
        $self = self::create(
            $deepLDocument->getFromProductWeb(),
            $deepLDocument->getToProductWeb(),
            $deepLDocument->getDocumentType(),
            $deepLDocument->getResultAction(),
            $deepLDocument->getContent(),
        );

        $self->from = $deepLDocument->getFromProductWeb();
        $self->to = $deepLDocument->getToProductWeb();
        $self->translatedContent = $deepLDocument->getTranslatedContent();
        $self->documentDeepLId = $deepLDocument->getTranslationDocumentId();

        return $self;
    }

    public static function create(
        ProductWeb $from,
        ProductWeb $to,
        DocumentType $documentType,
        ResultAction $resultAction,
        string $content,
    ): self {
        $self = new self(
            $from->getWeb()->getLangCode(),
            $to->getWeb()->getLangCode(),
            $documentType,
            $resultAction,
            $content
        );

        $self->from = $from;
        $self->to = $to;
        $self->translatedContent = '';

        return $self;
    }
}
