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
use function is_scalar;
use function preg_match;
use function sprintf;

/**
 * Validates whether the input is a valid phone number.
 *
 * Validates an international or country-specific telephone number
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Graham Campbell <graham@mineuk.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Phone extends AbstractRule
{
    /**
     * @var ?string
     */
    private $countryCode;

    public function __construct(?string $countryCode = null)
    {
        $this->countryCode = $countryCode;
        if ($countryCode === null) {
            return;
        }

        if (!(new CountryCode())->validate($countryCode)) {
            throw new ComponentException(sprintf('Invalid country code %s', $countryCode));
        }

        if (!class_exists(PhoneNumberUtil::class)) {
            throw new ComponentException('The phone validator requires giggsey/libphonenumber-for-php');
        }
    }

    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        if ($this->countryCode === null) {
            return preg_match($this->getPregFormat(), (string) $input) > 0;
        }

        return $this->isValidRegionalPhoneNumber((string) $input, $this->countryCode);
    }

    private function isValidRegionalPhoneNumber(string $input, string $countryCode): bool
    {
        try {
            $phoneNumberUtil = PhoneNumberUtil::getInstance();
            $phoneNumberObject = $phoneNumberUtil->parse($input, $countryCode);

            return $phoneNumberUtil->getRegionCodeForNumber($phoneNumberObject) === $countryCode;
        } catch (NumberParseException) {
        }

        return false;
    }

    private function getPregFormat(): string
    {
        return sprintf(
            '/^\+?(%1$s)? ?(?(?=\()(\(%2$s\) ?%3$s)|([. -]?(%2$s[. -]*)?%3$s))$/',
            '\d{0,3}',
            '\d{1,3}',
            '((\d{3,5})[. -]?(\d{2}[. -]?\d{2})|(\d{2}[. -]?){4})'
        );
    }
}
