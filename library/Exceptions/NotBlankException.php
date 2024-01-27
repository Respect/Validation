<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class NotBlankException extends ValidationException
{
    public const NAMED = 'named';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'The value must not be blank',
            self::NAMED => '{{name}} must not be blank',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'The value must be blank',
            self::NAMED => '{{name}} must be blank',
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
