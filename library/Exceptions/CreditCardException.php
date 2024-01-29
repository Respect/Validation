<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\CreditCard;
use Respect\Validation\Validatable;

final class CreditCardException extends ValidationException
{
    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must be a valid Credit Card number',
            CreditCard::TEMPLATE_BRANDED => '{{name}} must be a valid {{brand}} Credit Card number',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not be a valid Credit Card number',
            CreditCard::TEMPLATE_BRANDED => '{{name}} must not be a valid {{brand}} Credit Card number',
        ],
    ];
}
