<?php declare(strict_types = 1);

namespace App\Domain\Translation;

interface TranslatedDocument extends Document
{
    public function getTranslatedContent(): string;

    public function getTranslationDocumentId(): int;
}
