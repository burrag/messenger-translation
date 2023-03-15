<?php declare(strict_types = 1);

namespace App\Domain\Translation;

use App\Application\Translation\Messenger\ProcessProductDocument;

enum DocumentType: string
{

    case productDescription = 'product_description';

    public function getMessage(string $id): object
    {
        return match ($this) {
            self::productDescription => new ProcessProductDocument($id),
        };
    }
}
