<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\CreditCard;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 * @deprecated Using rule exceptions directly is deprecated, and will be removed in the next major version. Please use {@see ValidationException} instead.
 */
final class CreditCardException extends ValidationException
{
    public const BRANDED = 'branded';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid Credit Card number',
            self::BRANDED => '{{name}} must be a valid {{brand}} Credit Card number',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid Credit Card number',
            self::BRANDED => '{{name}} must not be a valid {{brand}} Credit Card number',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    protected function chooseTemplate(): string
    {
        if ($this->getParam('brand') === CreditCard::ANY) {
            return self::STANDARD;
        }

        return self::BRANDED;
    }
}
