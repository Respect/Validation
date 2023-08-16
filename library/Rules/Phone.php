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

use function class_exists;
use function is_null;
use function is_scalar;
use function sprintf;

/**
 * Validates whether the input is a valid phone number.
 *
 * Validates an international or country-specific telephone number
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 */
final class Phone extends AbstractRule
{
    /**
     * @var ?string
     */
    private $countryCode;

    /**
     * {@inheritDoc}
     */
    public function __construct(?string $countryCode = null)
    {
        $this->countryCode = $countryCode;

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
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
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
