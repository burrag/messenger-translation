<?php declare(strict_types = 1);

namespace App\Application\Translation\Messenger;

use App\Domain\Translation\ResultAction;

final readonly class ProcessProductDocument
{
    public function __construct(
        public string $id,
    ) {
    }
}
