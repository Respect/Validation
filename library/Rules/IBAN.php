<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_string;
use function str_replace;
use function strtoupper;
use function strlen;
use function preg_match;
use function substr;
use function preg_replace_callback;
use function strpos;
use function bcmod;

/**
 * Validates wether the input is a valid IBAN or not
 *
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
final class IBAN extends AbstractRule
{
    private const COUNTRIES_LENGTHS = [
        'AL' => 28,
        'AD' => 24,
        'AT' => 20,
        'AZ' => 28,
        'BH' => 22,
        'BE' => 16,
        'BA' => 20,
        'BR' => 29,
        'BG' => 22,
        'CR' => 21,
        'HR' => 21,
        'CY' => 28,
        'CZ' => 24,
        'DK' => 18,
        'DO' => 28,
        'EE' => 20,
        'FO' => 18,
        'FI' => 18,
        'FR' => 27,
        'GE' => 22,
        'DE' => 22,
        'GI' => 23,
        'GR' => 27,
        'GL' => 18,
        'GT' => 28,
        'HU' => 28,
        'IS' => 26,
        'IE' => 22,
        'IL' => 23,
        'IT' => 27,
        'JO' => 30,
        'KZ' => 20,
        'KW' => 30,
        'LV' => 21,
        'LB' => 28,
        'LI' => 21,
        'LT' => 20,
        'LU' => 20,
        'MK' => 19,
        'MT' => 31,
        'MR' => 27,
        'MU' => 30,
        'MD' => 24,
        'MC' => 27,
        'ME' => 22,
        'NL' => 18,
        'NO' => 15,
        'PK' => 24,
        'PL' => 28,
        'PS' => 29,
        'PT' => 25,
        'QA' => 29,
        'XK' => 20,
        'RO' => 24,
        'LC' => 32,
        'SM' => 27,
        'ST' => 25,
        'SA' => 24,
        'RS' => 22,
        'SC' => 31,
        'SK' => 24,
        'SI' => 19,
        'ES' => 24,
        'SE' => 24,
        'CH' => 21,
        'TL' => 23,
        'TN' => 24,
        'TR' => 26,
        'UA' => 29,
        'AE' => 23,
        'GB' => 22,
        'VG' => 24,
    ];

    private const ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {

        $IBAN = $this->validateStructure($input);

        if ($IBAN === false) {
            return false;
        }

        $countryCode = substr($IBAN, 0, 2);

        if (!isset(self::COUNTRIES_LENGTHS[$countryCode]) || self::COUNTRIES_LENGTHS[$countryCode] !== strlen($IBAN)) {
            return false;
        }

        $checkSum = substr($IBAN, 2, 2);
        $BBAN = substr($IBAN, 4);

        $reArrangedIBAN = $BBAN.$countryCode.$checkSum;

        $integerIBAN = preg_replace_callback('/[A-Z]/', function ($match) {
            return strpos(self::ALPHABET, $match[0]) + 10;
        }, $reArrangedIBAN);

        $remainder = (int)bcmod($integerIBAN, '97');

        return $remainder === 1;
    }

    /**
     * Makes sure that the input is adhering to the IBAN structure
     *
     * @param  string $input Suggested IBAN to test
     *
     * @return bool|string Return false on failure or a sanitized IBAN
     */
    private function validateStructure($input)
    {
        if (!is_string($input)) {
            return false;
        }

        $IBAN = str_replace(' ', '', strtoupper($input));

        if (!preg_match('/[A-Z0-9]{15,34}/', $IBAN)) {
            return false;
        }

        return $IBAN;
    }
}
