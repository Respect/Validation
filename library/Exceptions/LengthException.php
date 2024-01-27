<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class LengthException extends ValidationException
{
    public const BOTH = 'both';
    public const LOWER = 'lower';
    public const LOWER_INCLUSIVE = 'lower_inclusive';
    public const GREATER = 'greater';
    public const GREATER_INCLUSIVE = 'greater_inclusive';
    public const EXACT = 'exact';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::BOTH => '{{name}} must have a length between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}} must have a length greater than {{minValue}}',
            self::LOWER_INCLUSIVE => '{{name}} must have a length greater than or equal to {{minValue}}',
            self::GREATER => '{{name}} must have a length lower than {{maxValue}}',
            self::GREATER_INCLUSIVE => '{{name}} must have a length lower than or equal to {{maxValue}}',
            self::EXACT => '{{name}} must have a length of {{maxValue}}',
        ],
        self::MODE_NEGATIVE => [
            self::BOTH => '{{name}} must not have a length between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}} must not have a length greater than {{minValue}}',
            self::LOWER_INCLUSIVE => '{{name}} must not have a length greater than or equal to {{minValue}}',
            self::GREATER => '{{name}} must not have a length lower than {{maxValue}}',
            self::GREATER_INCLUSIVE => '{{name}} must not have a length lower than or equal to {{maxValue}}',
            self::EXACT => '{{name}} must not have a length of {{maxValue}}',
        ],
    ];

    protected function chooseTemplate(): string
    {
        $isInclusive = $this->getParam('inclusive');

        if (!$this->getParam('minValue')) {
            return $isInclusive === true ? self::GREATER_INCLUSIVE : self::GREATER;
        }

        if (!$this->getParam('maxValue')) {
            return $isInclusive === true ? self::LOWER_INCLUSIVE : self::LOWER;
        }

        if ($this->getParam('minValue') == $this->getParam('maxValue')) {
            return self::EXACT;
        }

        return self::BOTH;
    }
}
