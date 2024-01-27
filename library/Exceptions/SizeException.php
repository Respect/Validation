<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class SizeException extends NestedValidationException
{
    public const BOTH = 'both';
    public const LOWER = 'lower';
    public const GREATER = 'greater';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::BOTH => '{{name}} must be between {{minSize}} and {{maxSize}}',
            self::LOWER => '{{name}} must be greater than {{minSize}}',
            self::GREATER => '{{name}} must be lower than {{maxSize}}',
        ],
        self::MODE_NEGATIVE => [
            self::BOTH => '{{name}} must not be between {{minSize}} and {{maxSize}}',
            self::LOWER => '{{name}} must not be greater than {{minSize}}',
            self::GREATER => '{{name}} must not be lower than {{maxSize}}',
        ],
    ];

    protected function chooseTemplate(): string
    {
        if (!$this->getParam('minValue')) {
            return self::GREATER;
        }

        if (!$this->getParam('maxValue')) {
            return self::LOWER;
        }

        return self::BOTH;
    }
}
