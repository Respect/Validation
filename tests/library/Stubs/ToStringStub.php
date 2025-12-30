<?php

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

final class ToStringStub
{
    public function __construct(
        private readonly string $value,
    ) {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
