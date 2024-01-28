<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class PhoneException extends ValidationException
{
    public const FOR_COUNTRY = 'for_country';
    public const INTERNATIONAL = 'international';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::INTERNATIONAL => '{{name}} must be a valid telephone number',
            self::FOR_COUNTRY => '{{name}} must be a valid telephone number for country {{countryName}}',
        ],
        self::MODE_NEGATIVE => [
            self::INTERNATIONAL => '{{name}} must not be a valid telephone number',
            self::FOR_COUNTRY => '{{name}} must not be a valid telephone number for country {{countryName}}',
        ],
    ];

    protected function chooseTemplate(): string
    {
        $countryCode = $this->getParam('countryCode');

        if (!$countryCode) {
            return self::INTERNATIONAL;
        }

        return self::FOR_COUNTRY;
    }
}
