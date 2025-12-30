<?php

declare(strict_types=1);

namespace Respect\Validation\Message\Placeholder;

final readonly class Quoted
{
    public function __construct(
        public string $value,
    ) {
    }
}
