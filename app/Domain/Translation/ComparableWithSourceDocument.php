<?php declare(strict_types = 1);

namespace App\Domain\Translation;

interface ComparableWithSourceDocument
{
    public function isSame(): bool;
}
