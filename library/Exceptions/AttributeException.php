<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class AttributeException extends NestedValidationException implements NonOmissibleException
{
    public const NOT_PRESENT = 'not_present';
    public const INVALID = 'invalid';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NOT_PRESENT => 'Attribute {{name}} must be present',
            self::INVALID => 'Attribute {{name}} must be valid',
        ],
        self::MODE_NEGATIVE => [
            self::NOT_PRESENT => 'Attribute {{name}} must not be present',
            self::INVALID => 'Attribute {{name}} must not validate',
        ],
    ];

    protected function chooseTemplate(): string
    {
        return $this->getParam('hasReference') ? self::INVALID : self::NOT_PRESENT;
    }
}
