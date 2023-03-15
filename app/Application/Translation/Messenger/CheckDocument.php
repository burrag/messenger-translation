<?php declare(strict_types = 1);

namespace App\Application\Translation\Messenger;

final readonly class CheckDocument
{
    public function __construct(
        public string $id,
    ) {

    }
}
