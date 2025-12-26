<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Sokil\IsoCodes\Database\Countries;

use function class_exists;
use function is_scalar;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid telephone number',
    '{{subject}} must not be a valid telephone number',
    self::TEMPLATE_INTERNATIONAL,
)]
#[Template(
    '{{subject}} must be a valid telephone number for country {{countryName|trans}}',
    '{{subject}} must not be a valid telephone number for country {{countryName|trans}}',
    self::TEMPLATE_FOR_COUNTRY,
)]
final class Phone implements Rule
{
    public const string TEMPLATE_FOR_COUNTRY = '__for_country__';
    public const string TEMPLATE_INTERNATIONAL = '__international__';

    private readonly Countries\Country|null $country;

    public function __construct(string|null $countryCode = null, Countries|null $countries = null)
    {
        if (!class_exists(PhoneNumberUtil::class)) {
            throw new MissingComposerDependencyException(
                'Phone rule libphonenumber for PHP',
                'giggsey/libphonenumber-for-php',
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
                'sokil/php-isocodes-db-only',
            );
        }

        $countries ??= new Countries();
        $this->country = $countries->getByAlpha2($countryCode);
        if ($this->country === null) {
            throw new InvalidRuleConstructorException('Invalid country code %s', $countryCode);
        }
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['countryName' => $this->country?->getName()];
        $template = $this->country === null ? self::TEMPLATE_INTERNATIONAL : self::TEMPLATE_FOR_COUNTRY;
        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        return Result::of($this->isValidPhone((string) $input), $input, $this, $parameters, $template);
    }

    private function isValidPhone(string $input): bool
    {
        try {
            $phoneNumberUtil = PhoneNumberUtil::getInstance();
            $phoneNumberObject = $phoneNumberUtil->parse($input, $this->country?->getAlpha2());
            if ($this->country === null) {
                return $phoneNumberUtil->isValidNumber($phoneNumberObject);
            }

            return $phoneNumberUtil->getRegionCodeForNumber($phoneNumberObject) === $this->country->getAlpha2();
        } catch (NumberParseException) {
        }

        return false;
    }
}
