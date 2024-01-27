<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class NullableException extends ValidationException
{
    public const NAMED = 'named';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'The value must be nullable',
            self::NAMED => '{{name}} must be nullable',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'The value must not be null',
            self::NAMED => '{{name}} must not be null',
        ],
    ];

    protected function chooseTemplate(): string
    {
        if ($this->getParam('input') || $this->getParam('name')) {
            return self::NAMED;
        }

        return self::STANDARD;
    }
}
