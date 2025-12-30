<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use Respect\Validation\Message\Modifier;
use Respect\Validation\Message\Placeholder\Listed;
use Respect\Validation\Message\Translator;

use function is_array;

final readonly class ListOrModifier implements Modifier
{
    public function __construct(
        private Translator $translator,
        private Modifier $nextModifier,
    ) {
    }

    public function modify(mixed $value, string|null $pipe): string
    {
        if ($pipe !== 'listOr' || !is_array($value)) {
            return $this->nextModifier->modify($value, $pipe);
        }

        return $this->nextModifier->modify(
            new Listed($value, $this->translator->translate('or')),
            null,
        );
    }
}
