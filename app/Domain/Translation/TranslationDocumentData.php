<?php declare(strict_types = 1);

namespace App\Domain\Translation;

use App\Common\Core\Exception\LogicException;
use App\Common\Web\Translation\ResultAction;
use Grifart\Enum\MissingValueDeclarationException;

class TranslationDocumentData
{
    public string|null $resultAction = null;

    public int $from;

    public function getResultAction(): ResultAction
    {
        if ($this->resultAction === null) {
            throw LogicException::createNullValue('resultAction');
        }

        try {
            return ResultAction::fromScalar($this->resultAction);
        } catch (MissingValueDeclarationException $e) {
            throw LogicException::createFromPrevious($e);
        }
    }
}
