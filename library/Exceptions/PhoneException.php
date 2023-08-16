<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Helpers\CountryInfo;

/**
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Michael Firsikov <michael.firsikov@gmail.com>
 */
final class PhoneException extends ValidationException
{
    public const FOR_COUNTRY = 'for_country';
    public const INTERNATIONAL = 'international';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::INTERNATIONAL => '{{name}} must be a valid telephone number',
            self::FOR_COUNTRY => '{{name}} must be a valid telephone number for country {{countryName}}',
        ],
        self::MODE_NEGATIVE => [
            self::INTERNATIONAL => '{{name}} must not be a valid telephone number',
            self::FOR_COUNTRY => '{{name}} must not be a valid telephone number for country {{countryName}}',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    protected function chooseTemplate(): string
    {
        $countryCode = $this->getParam('countryCode');

        if (!$countryCode) {
            return self::INTERNATIONAL;
        }

        $countryInfo = new CountryInfo($countryCode);
        $this->setParam('countryName', $countryInfo->getCountry());

        return self::FOR_COUNTRY;
    }
}
