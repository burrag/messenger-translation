<?php declare(strict_types = 1);

namespace App\Domain\Translation;


interface TranslatingDocument extends Document
{
    public function getTranslationDocumentId(): string;

    public function getDocumentId(): string;

    public function getDocumentKey(): string;

    public function getStatus(): TranslationStatus;

    public function toTranslatedDocument(string $translatedContent): TranslatedDocument;
}
