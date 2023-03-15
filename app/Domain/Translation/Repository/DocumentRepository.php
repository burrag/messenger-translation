<?php declare(strict_types = 1);

namespace App\Domain\Translation\Repository;

use App\Domain\Translation\Document;
use App\Domain\Translation\ProductDocument;
use App\Domain\Translation\TranslatedDocument;
use App\Domain\Translation\TranslatingDocument;
use App\Domain\Translation\TranslationStatus;

interface DocumentRepository
{

    public function saveProductDocument($documentId, ProductDocument $document);

    public function getNextId(): string;

    public function getDocument(string $id): Document;

    public function updateDocument(string $id, TranslatingDocument $translatingDocument): void;

    public function getTranslatingDocument(string $id): TranslatingDocument;

    public function updateDocumentStatus(string $id, TranslationStatus $status): void;

    public function updateTranslatingDocument(string $getTranslationDocumentId, TranslatedDocument $translatedDocument): void;

    public function getProductDocument(string $id): ProductDocument;
}
