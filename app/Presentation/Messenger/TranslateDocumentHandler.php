<?php declare(strict_types = 1);

namespace App\Presentation\Messenger;

use App\Application\Translation\Messenger\TranslateDocument;
use App\Application\Translation\TranslationFacade;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final readonly class TranslateDocumentHandler implements MessageHandlerInterface
{
    public function __invoke(TranslateDocument $translateDocument): void
    {
        $this->translationFacade->translate($translateDocument->id);
    }

    public function __construct(
        private TranslationFacade $translationFacade,
    ) {
    }
}
