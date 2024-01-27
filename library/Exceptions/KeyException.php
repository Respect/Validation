<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class KeyException extends NestedValidationException implements NonOmissibleException
{
    public const NOT_PRESENT = 'not_present';
    public const INVALID = 'invalid';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NOT_PRESENT => '{{name}} must be present',
            self::INVALID => '{{name}} must be valid',
        ],
        self::MODE_NEGATIVE => [
            self::NOT_PRESENT => '{{name}} must not be present',
            self::INVALID => '{{name}} must not be valid',
        ],
    ];

    protected function chooseTemplate(): string
    {
        return $this->getParam('hasReference') ? self::INVALID : self::NOT_PRESENT;
    }
}
