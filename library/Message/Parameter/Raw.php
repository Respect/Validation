<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Parameter;

use function is_bool;
use function is_scalar;

final class Raw implements Processor
{
    public function __construct(
        private readonly Processor $nextProcessor,
    ) {
    }

    public function process(string $name, mixed $value, ?string $modifier = null): string
    {
        if ($modifier === 'raw' && is_scalar($value)) {
            return is_bool($value) ? (string) (int) $value : (string) $value;
        }

        return $this->nextProcessor->process($name, $value, $modifier);
    }
}
