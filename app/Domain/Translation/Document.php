<?php declare(strict_types = 1);

namespace App\Domain\Translation;


use App\Domain\Shared\Lang\LangCode;

interface Document
{
    public function getTranslationDocumentId(): string;

    public function getFromLang(): LangCode;

    public function getToLang(): LangCode;

    public function getDocumentType(): DocumentType;

    public function getContent(): string;

    public function getResultAction(): ResultAction;
}
