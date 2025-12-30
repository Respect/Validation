<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use Respect\Validation\Message\Modifier;
use Respect\Validation\Message\Placeholder\Quoted;

use function is_string;

final readonly class QuoteModifier implements Modifier
{
    public function __construct(
        private Modifier $nextModifier,
    ) {
    }

    public function modify(mixed $value, string|null $pipe): string
    {
        if ($pipe !== 'quote' || !is_string($value)) {
            return $this->nextModifier->modify($value, $pipe);
        }

        return $this->nextModifier->modify(new Quoted($value), null);
    }
}
