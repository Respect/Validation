<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use Respect\Validation\Message\Modifier;

use function is_bool;
use function is_scalar;

final readonly class RawModifier implements Modifier
{
    public function __construct(
        private Modifier $nextModifier,
    ) {
    }

    public function modify(mixed $value, string|null $pipe): string
    {
        if ($pipe !== 'raw') {
            return $this->nextModifier->modify($value, $pipe);
        }

        if (!is_scalar($value)) {
            return $this->nextModifier->modify($value, null);
        }

        return is_bool($value) ? (string) (int) $value : (string) $value;
    }
}
