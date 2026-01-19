<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use Respect\Validation\Message\Modifier;
use Respect\Validation\Message\Translator;

use function is_string;

final readonly class TransModifier implements Modifier
{
    public function __construct(
        private Translator $translator,
        private Modifier $nextModifier,
    ) {
    }

    public function modify(mixed $value, string|null $pipe): string
    {
        if ($pipe !== 'trans' || !is_string($value)) {
            return $this->nextModifier->modify($value, $pipe);
        }

        return $this->translator->translate($value);
    }
}
