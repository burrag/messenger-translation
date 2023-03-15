<?php declare(strict_types = 1);

namespace App\Domain\Shared\Lang;

final readonly class LangCode implements \Stringable
{
    public function __construct(
        public string $code,
    ) {
    }

    public function equal(object $other): bool
    {
        if ($other instanceof self === false) {
            return false;
        }

        return $other->code === $this->code;
    }

    public function toString(): string
    {
        return $this->code;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
