<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

use function sprintf;

/**
 * Validates whether the input is a valid postal code or not.
 *
 * @see http://download.geonames.org/export/dump/countryInfo.txt
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class PostalCode extends AbstractEnvelope
{
    private const DEFAULT_PATTERN = '/^$/';

    private const POSTAL_CODES_EXTRA = [
        // phpcs:disable Generic.Files.LineLength.TooLong
        'AM' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'BR' => ['/^\d\d\d\d\d-\d\d\d$/', '/^\d{5}-?\d{3}$/'],
        'EC' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'GR' => ['/^\d\d\d \d\d$/', '/^(\d{3}\s?\d{2})$/'],
        'GB' => ['/^\w\d \d\w\w|\w\d\d \d\w\w|\w\w\d \d\w\w|\w\w\d\d \d\w\w|\w\d\w \d\w\w|\w\w\d\w \d\w\w|GIR 0AA$/', '/^([Gg][Ii][Rr]\s?0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))\s?[0-9][A-Za-z]{2})$/'],
        'KH' => ['/^\d\d\d\d\d\d?$/', '/^(\d{5,6})$/'],
        'KY' => ['/^KY[1-3]-\d{4}$/', '/^KY[1-3]-?\d{4}$/'],
        'PT' => ['/^\d\d\d\d-\d\d\d$/', '/^\d{4}-?\d{3}\s?[a-zA-Z]{0,25}$/'],
        'RS' => ['/^\d\d\d\d\d\d?$/', '/^(\d{5,6})$/'],
        // phpcs:enable Generic.Files.LineLength.TooLong
    ];

    private const POSTAL_CODES = [
    // phpcs:disable Generic.Files.LineLength.TooLong
        'AD' => ['/^AD\d\d\d$/', '/^(?:AD)*(\d{3})$/'],
        'AE' => ['/^\d\d\d\d\d \d\d\d\d\d$/', '/^\d{5}-\d{5}$/'],
        'AI' => ['/^AI-\d\d\d\d$/', '/^(?:AZ)*(\d{4})$/'],
        'AL' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'AM' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'AR' => ['/^\w\d\d\d\d\w\w\w$/', '/^[A-Z]?\d{4}[A-Z]{0,3}$/'],
        'AS' => ['/^\d\d\d\d\d-\d\d\d\d$/', '/96799/'],
        'AT' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'AU' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'AX' => ['/^\d\d\d\d\d$/', '/^(?:FI)*(\d{5})$/'],
        'AZ' => ['/^AZ \d\d\d\d$/', '/^(?:AZ )*(\d{4})$/'],
        'BA' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'BB' => ['/^BB\d\d\d\d\d$/', '/^(?:BB)*(\d{5})$/'],
        'BD' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'BE' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'BG' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'BH' => ['/^\d\d\d\d|\d\d\d$/', '/^(\d{3}\d?)$/'],
        'BL' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'BM' => ['/^\w\w \d\d$/', '/^([A-Z]{2}\d{2})$/'],
        'BN' => ['/^\w\w\d\d\d\d$/', '/^([A-Z]{2}\d{4})$/'],
        'BR' => ['/^\d\d\d\d\d-\d\d\d$/', '/^\d{5}-\d{3}$/'],
        'BY' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'CA' => ['/^\w\d\w \d\w\d$/', '/^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]) ?(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$/'],
        'CC' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'CH' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'CL' => ['/^\d\d\d\d\d\d\d$/', '/^(\d{7})$/'],
        'CN' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'CO' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'CR' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'CS' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'CU' => ['/^CP \d\d\d\d\d$/', '/^(?:CP)*(\d{5})$/'],
        'CV' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'CX' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'CY' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'CZ' => ['/^\d\d\d \d\d$/', '/^\d{3}\s?\d{2}$/'],
        'DE' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'DK' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'DO' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'DZ' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'EC' => ['/^\w\d\d\d\d\w$/', '/^([a-zA-Z]\d{4}[a-zA-Z])$/'],
        'EE' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'EG' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'ES' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'ET' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'FI' => ['/^\d\d\d\d\d$/', '/^(?:FI)*(\d{5})$/'],
        'FK' => ['/^FIQQ 1ZZ$/', '/FIQQ 1ZZ/'],
        'FM' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'FO' => ['/^\d\d\d$/', '/^(?:FO)*(\d{3})$/'],
        'FR' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'GB' => ['/^\w\d \d\w\w|\w\d\d \d\w\w|\w\w\d \d\w\w|\w\w\d\d \d\w\w|\w\d\w \d\w\w|\w\w\d\w \d\w\w|GIR0AA$/', '/^([Gg][Ii][Rr]\s?0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))\s?[0-9][A-Za-z]{2})$/'],
        'GE' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'GF' => ['/^\d\d\d\d\d$/', '/^((97|98)3\d{2})$/'],
        'GG' => ['/^\w\d \d\w\w|\w\d\d \d\w\w|\w\w\d \d\w\w|\w\w\d\d \d\w\w|\w\d\w \d\w\w|\w\w\d\w \d\w\w|GIR0AA$/', '/^((?:(?:[A-PR-UWYZ][A-HK-Y]\d[ABEHMNPRV-Y0-9]|[A-PR-UWYZ]\d[A-HJKPS-UW0-9])\s\d[ABD-HJLNP-UW-Z]{2})|GIR\s?0AA)$/'],
        'GI' => ['/^GX11 1AA$/', '/GX11 1AA/'],
        'GL' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'GP' => ['/^\d\d\d\d\d$/', '/^((97|98)\d{3})$/'],
        'GR' => ['/^\d\d\d \d\d$/', '/^(\d{5})$/'],
        'GS' => ['/^SIQQ 1ZZ$/', '/SIQQ 1ZZ/'],
        'GT' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'GU' => ['/^969\d\d$/', '/^(969\d{2})$/'],
        'GW' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'HK' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'HM' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'HN' => ['/^\d\d\d\d\d$/', '/^(\d{6})$/'],
        'HR' => ['/^\d\d\d\d\d$/', '/^(?:HR)*(\d{5})$/'],
        'HT' => ['/^HT\d\d\d\d$/', '/^(?:HT)*(\d{4})$/'],
        'HU' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'ID' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'IE' => ['/^\w\w\w \w\w\w\w$/', '/^(D6W|[AC-FHKNPRTV-Y][0-9]{2})\s?([AC-FHKNPRTV-Y0-9]{4})/'],
        'IL' => ['/^\d\d\d\d\d\d\d$/', '/^(\d{7}|\d{5})$/'],
        'IM' => ['/^\w\d \d\w\w|\w\d\d \d\w\w|\w\w\d \d\w\w|\w\w\d\d \d\w\w|\w\d\w \d\w\w|\w\w\d\w \d\w\w|GIR0AA$/', '/^((?:(?:[A-PR-UWYZ][A-HK-Y]\d[ABEHMNPRV-Y0-9]|[A-PR-UWYZ]\d[A-HJKPS-UW0-9])\s\d[ABD-HJLNP-UW-Z]{2})|GIR\s?0AA)$/'],
        'IN' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'IO' => ['/^BBND 1ZZ$/', '/BBND 1ZZ/'],
        'IQ' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'IR' => ['/^\d\d\d\d\d\d\d\d\d\d$/', '/^(\d{10})$/'],
        'IS' => ['/^\d\d\d$/', '/^(\d{3})$/'],
        'IT' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'JE' => ['/^\w\d \d\w\w|\w\d\d \d\w\w|\w\w\d \d\w\w|\w\w\d\d \d\w\w|\w\d\w \d\w\w|\w\w\d\w \d\w\w|GIR0AA$/', '/^((?:(?:[A-PR-UWYZ][A-HK-Y]\d[ABEHMNPRV-Y0-9]|[A-PR-UWYZ]\d[A-HJKPS-UW0-9])\s\d[ABD-HJLNP-UW-Z]{2})|GIR\s?0AA)$/'],
        'JO' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'JP' => ['/^\d\d\d-\d\d\d\d$/', '/^\d{3}-\d{4}$/'],
        'KE' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'KG' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'KH' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'KP' => ['/^\d\d\d-\d\d\d$/', '/^(\d{6})$/'],
        'KR' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'KW' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'KZ' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'LA' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'LB' => ['/^\d\d\d\d \d\d\d\d|\d\d\d\d$/', '/^(\d{4}(\d{4})?)$/'],
        'LI' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'LK' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'LR' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'LS' => ['/^\d\d\d$/', '/^(\d{3})$/'],
        'LT' => ['/^LT-\d\d\d\d\d$/', '/^(?:LT)*(\d{5})$/'],
        'LU' => ['/^L-\d\d\d\d$/', '/^(?:L-)?\d{4}$/'],
        'LV' => ['/^LV-\d\d\d\d$/', '/^(?:LV)*(\d{4})$/'],
        'MA' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'MC' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'MD' => ['/^MD-\d\d\d\d$/', '/^MD-\d{4}$/'],
        'ME' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'MF' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'MG' => ['/^\d\d\d$/', '/^(\d{3})$/'],
        'MH' => ['/^\d\d\d\d\d-\d\d\d\d$/', '/^969\d{2}(-\d{4})$/'],
        'MK' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'MM' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'MN' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'MO' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'MP' => ['/^\d\d\d\d\d$/', '/^9695\d{1}$/'],
        'MQ' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'MT' => ['/^\w\w\w \d\d\d\d$/', '/^[A-Z]{3}\s?\d{4}$/'],
        'MV' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'MW' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'MX' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'MY' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'MZ' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'NC' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'NE' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'NF' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'NG' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'NI' => ['/^\d\d\d-\d\d\d-\d$/', '/^(\d{7})$/'],
        'NL' => ['/^\d\d\d\d \w\w$/', '/^(\d{4}\s?[a-zA-Z]{2})$/'],
        'NO' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'NP' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'NR' => ['/^NRU68$/', '/NRU68/'],
        'NU' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'NZ' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'OM' => ['/^\d\d\d$/', '/^(\d{3})$/'],
        'PA' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'PE' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'PF' => ['/^\d\d\d\d\d$/', '/^((97|98)7\d{2})$/'],
        'PG' => ['/^\d\d\d$/', '/^(\d{3})$/'],
        'PH' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'PK' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'PL' => ['/^\d\d-\d\d\d$/', '/^\d{2}-\d{3}$/'],
        'PM' => ['/^\d\d\d\d\d$/', '/^(97500)$/'],
        'PN' => ['/^PCRN 1ZZ$/', '/PCRN 1ZZ/'],
        'PR' => ['/^\d\d\d\d\d-\d\d\d\d$/', '/^00[679]\d{2}(?:-\d{4})?$/'],
        'PT' => ['/^\d\d\d\d-\d\d\d$/', '/^\d{4}-\d{3}\s?[a-zA-Z]{0,25}$/'],
        'PW' => ['/^96940$/', '/^(96940)$/'],
        'PY' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'RE' => ['/^\d\d\d\d\d$/', '/^((97|98)(4|7|8)\d{2})$/'],
        'RO' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'RS' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'RU' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'SA' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'SD' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'SE' => ['/^\d\d\d \d\d$/', '/^(?:SE)?\d{3}\s\d{2}$/'],
        'SG' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'SH' => ['/^STHL 1ZZ$/', '/^(STHL1ZZ)$/'],
        'SI' => ['/^\d\d\d\d$/', '/^(?:SI)*(\d{4})$/'],
        'SJ' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'SK' => ['/^\d\d\d \d\d$/', '/^\d{3}\s?\d{2}$/'],
        'SM' => ['/^4789\d$/', '/^(4789\d)$/'],
        'SN' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'SO' => ['/^\w\w  \d\d\d\d\d$/', '/^([A-Z]{2}\d{5})$/'],
        'SV' => ['/^CP \d\d\d\d$/', '/^(?:CP)*(\d{4})$/'],
        'SZ' => ['/^\w\d\d\d$/', '/^([A-Z]\d{3})$/'],
        'TC' => ['/^TKCA 1ZZ$/', '/^(TKCA 1ZZ)$/'],
        'TD' => ['/^TKCA 1ZZ$/', '/^(TKCA 1ZZ)$/'],
        'TH' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'TJ' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'TM' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'TN' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'TR' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'TW' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'UA' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'US' => ['/^\d\d\d\d\d-\d\d\d\d$/', '/^\d{5}(-\d{4})?$/'],
        'UY' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'UZ' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'VA' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'VE' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'VI' => ['/^\d\d\d\d\d-\d\d\d\d$/', '/^008\d{2}(?:-\d{4})?$/'],
        'VN' => ['/^\d\d\d\d\d\d$/', '/^(\d{6})$/'],
        'WF' => ['/^\d\d\d\d\d$/', '/^(986\d{2})$/'],
        'WS' => ['/^AS 96799$/', '/AS 96799/'],
        'YT' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
        'ZA' => ['/^\d\d\d\d$/', '/^(\d{4})$/'],
        'ZM' => ['/^\d\d\d\d\d$/', '/^(\d{5})$/'],
    // phpcs:disable Generic.Files.LineLength.TooLong
    ];//end

    public function __construct(string $countryCode, bool $formatted = false)
    {
        $countryCodeRule = new CountryCode();
        if (!$countryCodeRule->validate($countryCode)) {
            throw new ComponentException(sprintf('Cannot validate postal code from "%s" country', $countryCode));
        }

        parent::__construct(
            new Regex(
                self::POSTAL_CODES_EXTRA[$countryCode][$formatted ? 0 : 1] ?? self::POSTAL_CODES[$countryCode][$formatted ? 0 : 1] ?? self::DEFAULT_PATTERN
            ),
            ['countryCode' => $countryCode]
        );
    }
}
