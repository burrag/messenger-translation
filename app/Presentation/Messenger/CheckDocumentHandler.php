<?php declare(strict_types = 1);

namespace App\Presentation\Messenger;

use App\Application\Translation\Messenger\CheckDocument;
use App\Application\Translation\TranslationFacade;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final readonly class CheckDocumentHandler implements MessageHandlerInterface
{
    public function __invoke(CheckDocument $checkDocument): void
    {
        $this->translationFacade->checkDocument($checkDocument->id);
    }


    public function __construct(
        private TranslationFacade $translationFacade,
    ) {
    }
}
