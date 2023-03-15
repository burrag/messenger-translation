<?php declare(strict_types = 1);

namespace App\Domain\Translation;

interface Client
{

    public function translateDocument(string $id, Document $document): TranslatingDocument;

    public function checkStatus(TranslatingDocument $document): TranslationStatus;

    public function getResult(TranslatingDocument $document): TranslatedDocument;
}
