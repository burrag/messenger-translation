<?php declare(strict_types = 1);

namespace App\Domain\Translation;

enum TranslationStatus: string
{
    case new = 'new';
    case queued = 'queued';
    case translating = 'translating';
    case translated = 'translated';
    case done = 'done';
    case error = 'error';
}
