<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Eduardo Reveles <me@osiux.ws>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Henrique Oliveira <henrique.oliveira83@yahoo.com.br>
 * SPDX-FileContributor: mf <michael.firsikov@gmail.com>
 * SPDX-FileContributor: Michael Firsikov <michael@vstadi.com>
 * SPDX-FileContributor: RCooLeR <roman.derevianko@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Psr\Container\NotFoundExceptionInterface;
use Respect\Validation\ContainerRegistry;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Sokil\IsoCodes\Database\Countries;

use function is_scalar;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a phone number',
    '{{subject}} must not be a phone number',
    self::TEMPLATE_INTERNATIONAL,
)]
#[Template(
    '{{subject}} must be a phone number for country {{countryName|trans}}',
    '{{subject}} must not be a phone number for country {{countryName|trans}}',
    self::TEMPLATE_FOR_COUNTRY,
)]
final class Phone implements Validator
{
    public const string TEMPLATE_FOR_COUNTRY = '__for_country__';
    public const string TEMPLATE_INTERNATIONAL = '__international__';

    private readonly Countries\Country|null $country;

    public function __construct(string|null $countryCode = null, Countries|null $countries = null)
    {
        if (!ContainerRegistry::getContainer()->has(PhoneNumberUtil::class)) {
            throw new MissingComposerDependencyException(
                'Phone rule requires libphonenumber for PHP',
                'giggsey/libphonenumber-for-php',
            );
        }

        if ($countryCode == null) {
            $this->country = null;

            return;
        }

        try {
            $countries ??= ContainerRegistry::getContainer()->get(Countries::class);
        } catch (NotFoundExceptionInterface) {
            throw new MissingComposerDependencyException(
                'Phone rule with country code requires PHP ISO Codes',
                'sokil/php-isocodes',
                'sokil/php-isocodes-db-only',
            );
        }

        $this->country = $countries->getByAlpha2($countryCode);
        if ($this->country === null) {
            throw new InvalidValidatorException('Invalid country code %s', $countryCode);
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
            $phoneNumberUtil = ContainerRegistry::getContainer()->get(PhoneNumberUtil::class);
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
