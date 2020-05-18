<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
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
    private const POSTAL_CODES = [
        // phpcs:disable Generic.Files.LineLength.TooLong
        'AD' => '/^(?:AD)*(\d{3})$/',
        'AL' => '/^(\d{4})$/',
        'AM' => '/^(\d{4})$/',
        'AR' => '/^[A-Z]?\d{4}[A-Z]{0,3}$/',
        'AS' => '/96799/',
        'AT' => '/^(\d{4})$/',
        'AU' => '/^(\d{4})$/',
        'AX' => '/^(?:FI)*(\d{5})$/',
        'AZ' => '/^(?:AZ)*(\d{4})$/',
        'BA' => '/^(\d{5})$/',
        'BB' => '/^(?:BB)*(\d{5})$/',
        'BD' => '/^(\d{4})$/',
        'BE' => '/^(\d{4})$/',
        'BG' => '/^(\d{4})$/',
        'BH' => '/^(\d{3}\d?)$/',
        'BL' => '/^(\d{5})$/',
        'BM' => '/^([A-Z]{2}\d{2})$/',
        'BN' => '/^([A-Z]{2}\d{4})$/',
        'BR' => '/^\d{5}-?\d{3}$/',
        'BY' => '/^(\d{6})$/',
        'CA' => '/^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]) ?(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$/',
        'CH' => '/^(\d{4})$/',
        'CL' => '/^(\d{7})$/',
        'CN' => '/^(\d{6})$/',
        'CO' => '/^(\d{6})$/',
        'CR' => '/^(\d{5})$/',
        'CS' => '/^(\d{5})$/',
        'CU' => '/^(?:CP)*(\d{5})$/',
        'CV' => '/^(\d{4})$/',
        'CX' => '/^(\d{4})$/',
        'CY' => '/^(\d{4})$/',
        'CZ' => '/^\d{3}\s?\d{2}$/',
        'DE' => '/^(\d{5})$/',
        'DK' => '/^(\d{4})$/',
        'DO' => '/^(\d{5})$/',
        'DZ' => '/^(\d{5})$/',
        'EC' => '/^(\d{6})$/',
        'EE' => '/^(\d{5})$/',
        'EG' => '/^(\d{5})$/',
        'ES' => '/^(\d{5})$/',
        'ET' => '/^(\d{4})$/',
        'FI' => '/^(?:FI)*(\d{5})$/',
        'FM' => '/^(\d{5})$/',
        'FO' => '/^(?:FO)*(\d{3})$/',
        'FR' => '/^(\d{5})$/',
        'GB' => '/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/',
        'GE' => '/^(\d{4})$/',
        'GF' => '/^((97|98)3\d{2})$/',
        'GG' => '/^((?:(?:[A-PR-UWYZ][A-HK-Y]\d[ABEHMNPRV-Y0-9]|[A-PR-UWYZ]\d[A-HJKPS-UW0-9])\s\d[ABD-HJLNP-UW-Z]{2})|GIR\s?0AA)$/',
        'GL' => '/^(\d{4})$/',
        'GP' => '/^((97|98)\d{3})$/',
        'GR' => '/^(\d{5})$/',
        'GT' => '/^(\d{5})$/',
        'GU' => '/^(969\d{2})$/',
        'GW' => '/^(\d{4})$/',
        'HN' => '/^([A-Z]{2}\d{4})$/',
        'HR' => '/^(?:HR)*(\d{5})$/',
        'HT' => '/^(?:HT)*(\d{4})$/',
        'HU' => '/^(\d{4})$/',
        'ID' => '/^(\d{5})$/',
        'IE' => '/^(D6W|[AC-FHKNPRTV-Y][0-9]{2})\s?([AC-FHKNPRTV-Y0-9]{4})/',
        'IL' => '/^(\d{7}|\d{5})$/',
        'IM' => '/^((?:(?:[A-PR-UWYZ][A-HK-Y]\d[ABEHMNPRV-Y0-9]|[A-PR-UWYZ]\d[A-HJKPS-UW0-9])\s\d[ABD-HJLNP-UW-Z]{2})|GIR\s?0AA)$/',
        'IN' => '/^(\d{6})$/',
        'IQ' => '/^(\d{5})$/',
        'IR' => '/^(\d{10})$/',
        'IS' => '/^(\d{3})$/',
        'IT' => '/^(\d{5})$/',
        'JE' => '/^((?:(?:[A-PR-UWYZ][A-HK-Y]\d[ABEHMNPRV-Y0-9]|[A-PR-UWYZ]\d[A-HJKPS-UW0-9])\s\d[ABD-HJLNP-UW-Z]{2})|GIR\s?0AA)$/',
        'JO' => '/^(\d{5})$/',
        'JP' => '/^\d{3}-\d{4}$/',
        'KE' => '/^(\d{5})$/',
        'KG' => '/^(\d{6})$/',
        'KH' => '/^(\d{5})$/',
        'KP' => '/^(\d{6})$/',
        'KR' => '/^(\d{5})$/',
        'KW' => '/^(\d{5})$/',
        'KY' => '/^KY[1-3]-\d{4}$/',
        'KZ' => '/^(\d{6})$/',
        'LA' => '/^(\d{5})$/',
        'LB' => '/^(\d{4}(\d{4})?)$/',
        'LI' => '/^(\d{4})$/',
        'LK' => '/^(\d{5})$/',
        'LR' => '/^(\d{4})$/',
        'LS' => '/^(\d{3})$/',
        'LT' => '/^(?:LT)*(\d{5})$/',
        'LU' => '/^(?:L-)?\d{4}$/',
        'LV' => '/^(?:LV)*(\d{4})$/',
        'MA' => '/^(\d{5})$/',
        'MC' => '/^(\d{5})$/',
        'MD' => '/^MD-\d{4}$/',
        'ME' => '/^(\d{5})$/',
        'MF' => '/^(\d{5})$/',
        'MG' => '/^(\d{3})$/',
        'MH' => '/^969\d{2}(-\d{4})$/',
        'MK' => '/^(\d{4})$/',
        'MM' => '/^(\d{5})$/',
        'MN' => '/^(\d{6})$/',
        'MP' => '/^9695\d{1}$/',
        'MQ' => '/^(\d{5})$/',
        'MT' => '/^[A-Z]{3}\s?\d{4}$/',
        'MV' => '/^(\d{5})$/',
        'MW' => '/^(\d{6})$/',
        'MX' => '/^(\d{5})$/',
        'MY' => '/^(\d{5})$/',
        'MZ' => '/^(\d{4})$/',
        'NC' => '/^(\d{5})$/',
        'NE' => '/^(\d{4})$/',
        'NF' => '/^(\d{4})$/',
        'NG' => '/^(\d{6})$/',
        'NI' => '/^(\d{7})$/',
        'NL' => '/^(\d{4} ?[A-Z]{2})$/',
        'NO' => '/^(\d{4})$/',
        'NP' => '/^(\d{5})$/',
        'NZ' => '/^(\d{4})$/',
        'OM' => '/^(\d{3})$/',
        'PF' => '/^((97|98)7\d{2})$/',
        'PG' => '/^(\d{3})$/',
        'PH' => '/^(\d{4})$/',
        'PK' => '/^(\d{5})$/',
        'PL' => '/^\d{2}-\d{3}$/',
        'PM' => '/^(97500)$/',
        'PR' => '/^00[679]\d{2}(?:-\d{4})?$/',
        'PT' => '/^\d{4}-?\d{3}$/',
        'PW' => '/^(96940)$/',
        'PY' => '/^(\d{4})$/',
        'RE' => '/^((97|98)(4|7|8)\d{2})$/',
        'RO' => '/^(\d{6})$/',
        'RS' => '/^(\d{6})$/',
        'RU' => '/^(\d{6})$/',
        'SA' => '/^(\d{5})$/',
        'SD' => '/^(\d{5})$/',
        'SE' => '/^(?:SE)?\d{3}\s\d{2}$/',
        'SG' => '/^(\d{6})$/',
        'SH' => '/^(STHL1ZZ)$/',
        'SI' => '/^(?:SI)*(\d{4})$/',
        'SJ' => '/^(\d{4})$/',
        'SK' => '/^\d{3}\s?\d{2}$/',
        'SM' => '/^(4789\d)$/',
        'SN' => '/^(\d{5})$/',
        'SO' => '/^([A-Z]{2}\d{5})$/',
        'SV' => '/^(?:CP)*(\d{4})$/',
        'SZ' => '/^([A-Z]\d{3})$/',
        'TC' => '/^(TKCA 1ZZ)$/',
        'TH' => '/^(\d{5})$/',
        'TJ' => '/^(\d{6})$/',
        'TM' => '/^(\d{6})$/',
        'TN' => '/^(\d{4})$/',
        'TR' => '/^(\d{5})$/',
        'TW' => '/^(\d{5})$/',
        'UA' => '/^(\d{5})$/',
        'US' => '/^\d{5}(-\d{4})?$/',
        'UY' => '/^(\d{5})$/',
        'UZ' => '/^(\d{6})$/',
        'VA' => '/^(\d{5})$/',
        'VE' => '/^(\d{4})$/',
        'VI' => '/^008\d{2}(?:-\d{4})?$/',
        'VN' => '/^(\d{6})$/',
        'WF' => '/^(986\d{2})$/',
        'YT' => '/^(\d{5})$/',
        'ZA' => '/^(\d{4})$/',
        'ZM' => '/^(\d{5})$/',
        // phpcs:enable Generic.Files.LineLength.TooLong
    ];

    public function __construct(string $countryCode)
    {
        $countryCodeRule = new CountryCode();
        if (!$countryCodeRule->validate($countryCode)) {
            throw new ComponentException(sprintf('Cannot validate postal code from "%s" country', $countryCode));
        }

        parent::__construct(
            new Regex(self::POSTAL_CODES[$countryCode] ?? self::DEFAULT_PATTERN),
            ['countryCode' => $countryCode]
        );
    }
}
