<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Message\Template;
use Sokil\IsoCodes\Database\Countries;

use function class_exists;
use function is_scalar;
use function sprintf;

#[Template(
    '{{name}} must be a valid telephone number',
    '{{name}} must not be a valid telephone number',
    self::TEMPLATE_INTERNATIONAL,
)]
#[Template(
    '{{name}} must be a valid telephone number for country {{countryName|trans}}',
    '{{name}} must not be a valid telephone number for country {{countryName|trans}}',
    self::TEMPLATE_FOR_COUNTRY,
)]
final class Phone extends AbstractRule
{
    public const TEMPLATE_FOR_COUNTRY = '__for_country__';
    public const TEMPLATE_INTERNATIONAL = '__international__';

    private readonly ?Countries\Country $country;

    public function __construct(?string $countryCode = null, ?Countries $countries = null)
    {
        if (!class_exists(PhoneNumberUtil::class)) {
            throw new MissingComposerDependencyException(
                'Phone rule libphonenumber for PHP',
                'giggsey/libphonenumber-for-php'
            );
        }

        if ($countryCode == null) {
            $this->country = null;

            return;
        }

        if (!class_exists(Countries::class)) {
            throw new MissingComposerDependencyException(
                'Phone rule with country code requires PHP ISO Codes',
                'sokil/php-isocodes',
                'sokil/php-isocodes-db-only'
            );
        }

        $countries ??= new Countries();
        $this->country = $countries->getByAlpha2($countryCode);
        if ($this->country === null) {
            throw new ComponentException(sprintf('Invalid country code %s', $countryCode));
        }
    }

    public function validate(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        try {
            return PhoneNumberUtil::getInstance()->isValidNumber(
                PhoneNumberUtil::getInstance()->parse((string) $input, $this->country?->getAlpha2())
            );
        } catch (NumberParseException $e) {
            return false;
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return ['countryName' => $this->country?->getName()];
    }

    protected function getStandardTemplate(mixed $input): string
    {
        return $this->country ? self::TEMPLATE_FOR_COUNTRY : self::TEMPLATE_INTERNATIONAL;
    }
}
