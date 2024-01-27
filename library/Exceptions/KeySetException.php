<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use function count;

final class KeySetException extends GroupedValidationException implements NonOmissibleException
{
    public const STRUCTURE = 'structure';
    public const STRUCTURE_EXTRA = 'structure_extra';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NONE => 'All of the required rules must pass for {{name}}',
            self::SOME => 'These rules must pass for {{name}}',
            self::STRUCTURE => 'Must have keys {{keys}}',
            self::STRUCTURE_EXTRA => 'Must not have keys {{extraKeys}}',
        ],
    ];

    protected function chooseTemplate(): string
    {
        if (count($this->getParam('extraKeys'))) {
            return self::STRUCTURE_EXTRA;
        }

        if (count($this->getChildren()) === 0) {
            return self::STRUCTURE;
        }

        return parent::chooseTemplate();
    }
}
