<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class KeyNestedException extends NestedValidationException implements NonOmissibleException
{
    public const NOT_PRESENT = 'not_present';
    public const INVALID = 'invalid';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NOT_PRESENT => 'No items were found for key chain {{name}}',
            self::INVALID => 'Key chain {{name}} is not valid',
        ],
        self::MODE_NEGATIVE => [
            self::NOT_PRESENT => 'Items for key chain {{name}} must not be present',
            self::INVALID => 'Key chain {{name}} must not be valid',
        ],
    ];

    protected function chooseTemplate(): string
    {
        return $this->getParam('hasReference') ? self::INVALID : self::NOT_PRESENT;
    }
}
