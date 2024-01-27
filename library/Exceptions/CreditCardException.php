<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\CreditCard;

final class CreditCardException extends ValidationException
{
    public const BRANDED = 'branded';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid Credit Card number',
            self::BRANDED => '{{name}} must be a valid {{brand}} Credit Card number',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid Credit Card number',
            self::BRANDED => '{{name}} must not be a valid {{brand}} Credit Card number',
        ],
    ];

    protected function chooseTemplate(): string
    {
        if ($this->getParam('brand') === CreditCard::ANY) {
            return self::STANDARD;
        }

        return self::BRANDED;
    }
}
