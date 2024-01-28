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
use Respect\Validation\Helpers\CountryInfo;

use function class_exists;
use function is_null;
use function is_scalar;
use function sprintf;

final class Phone extends AbstractRule
{
    private readonly ?string $countryName;

    public function __construct(private readonly ?string $countryCode = null)
    {
        if (!is_null($countryCode) && !(new CountryCode())->validate($countryCode)) {
            throw new ComponentException(
                sprintf(
                    'Invalid country code %s',
                    $countryCode
                )
            );
        }

        if (!class_exists(PhoneNumberUtil::class)) {
            throw new ComponentException('The phone validator requires giggsey/libphonenumber-for-php');
        }

        $this->countryName = $countryCode === null ? null : (new CountryInfo($countryCode))->getCountry();
    }

    public function validate(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        try {
            return PhoneNumberUtil::getInstance()->isValidNumber(
                PhoneNumberUtil::getInstance()->parse((string) $input, $this->countryCode)
            );
        } catch (NumberParseException $e) {
            return false;
        }
    }
}
