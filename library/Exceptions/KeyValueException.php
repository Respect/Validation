<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class KeyValueException extends ValidationException
{
    public const COMPONENT = 'component';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Key {{name}} must be present',
            self::COMPONENT => '{{baseKey}} must be valid to validate {{comparedKey}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Key {{name}} must not be present',
            self::COMPONENT => '{{baseKey}} must not be valid to validate {{comparedKey}}',
        ],
    ];

    protected function chooseTemplate(): string
    {
        return $this->getParam('component') ? self::COMPONENT : self::STANDARD;
    }
}
