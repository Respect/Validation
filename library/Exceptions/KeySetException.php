<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\KeySet;

final class KeySetException extends GroupedValidationException implements NonOmissibleException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            KeySet::TEMPLATE_NONE => 'All of the required rules must pass for {{name}}',
            KeySet::TEMPLATE_SOME => 'These rules must pass for {{name}}',
            KeySet::TEMPLATE_STRUCTURE => 'Must have keys {{keys}}',
            KeySet::TEMPLATE_STRUCTURE_EXTRA => 'Must not have keys {{extraKeys}}',
        ],
    ];
}
