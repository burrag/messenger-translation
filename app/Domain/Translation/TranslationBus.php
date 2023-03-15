<?php declare(strict_types = 1);

namespace App\Domain\Translation;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\StampInterface;

final class TranslationBus implements MessageBusInterface
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param array<StampInterface> $stamps
     */
    public function dispatch(object $message, array $stamps = []): Envelope
    {
        return $this->messageBus->dispatch($message, $stamps);
    }
}
