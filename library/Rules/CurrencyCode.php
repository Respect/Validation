<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * Validates currency codes in ISO 4217.
 */
class CurrencyCode extends AbstractRule
{
    /**
     * @link http://www.currency-iso.org/en/home/tables/table-a1.html
     *
     * @var array
     */
    private $currencyCodes = [
        'AFN', // Afghani
        'EUR', // Euro
        'ALL', // Lek
        'DZD', // Algerian Dinar
        'USD', // US Dollar
        'EUR', // Euro
        'AOA', // Kwanza
        'XCD', // East Caribbean Dollar
        '', // No universal currency
        'XCD', // East Caribbean Dollar
        'ARS', // Argentine Peso
        'AMD', // Armenian Dram
        'AWG', // Aruban Florin
        'AUD', // Australian Dollar
        'EUR', // Euro
        'AZN', // Azerbaijan Manat
        'BSD', // Bahamian Dollar
        'BHD', // Bahraini Dinar
        'BDT', // Taka
        'BBD', // Barbados Dollar
        'BYN', // Belarusian Ruble
        'EUR', // Euro
        'BZD', // Belize Dollar
        'XOF', // CFA Franc BCEAO
        'BMD', // Bermudian Dollar
        'INR', // Indian Rupee
        'BTN', // Ngultrum
        'BOB', // Boliviano
        'BOV', // Mvdol
        'USD', // US Dollar
        'BAM', // Convertible Mark
        'BWP', // Pula
        'NOK', // Norwegian Krone
        'BRL', // Brazilian Real
        'USD', // US Dollar
        'BND', // Brunei Dollar
        'BGN', // Bulgarian Lev
        'XOF', // CFA Franc BCEAO
        'BIF', // Burundi Franc
        'CVE', // Cabo Verde Escudo
        'KHR', // Riel
        'XAF', // CFA Franc BEAC
        'CAD', // Canadian Dollar
        'KYD', // Cayman Islands Dollar
        'XAF', // CFA Franc BEAC
        'XAF', // CFA Franc BEAC
        'CLP', // Chilean Peso
        'CLF', // Unidad de Fomento
        'CNY', // Yuan Renminbi
        'AUD', // Australian Dollar
        'AUD', // Australian Dollar
        'COP', // Colombian Peso
        'COU', // Unidad de Valor Real
        'KMF', // Comorian Franc 
        'CDF', // Congolese Franc
        'XAF', // CFA Franc BEAC
        'NZD', // New Zealand Dollar
        'CRC', // Costa Rican Colon
        'XOF', // CFA Franc BCEAO
        'HRK', // Kuna
        'CUP', // Cuban Peso
        'CUC', // Peso Convertible
        'ANG', // Netherlands Antillean Guilder
        'EUR', // Euro
        'CZK', // Czech Koruna
        'DKK', // Danish Krone
        'DJF', // Djibouti Franc
        'XCD', // East Caribbean Dollar
        'DOP', // Dominican Peso
        'USD', // US Dollar
        'EGP', // Egyptian Pound
        'SVC', // El Salvador Colon
        'USD', // US Dollar
        'XAF', // CFA Franc BEAC
        'ERN', // Nakfa
        'EUR', // Euro
        'ETB', // Ethiopian Birr
        'EUR', // Euro
        'FKP', // Falkland Islands Pound
        'DKK', // Danish Krone
        'FJD', // Fiji Dollar
        'EUR', // Euro
        'EUR', // Euro
        'EUR', // Euro
        'XPF', // CFP Franc
        'EUR', // Euro
        'XAF', // CFA Franc BEAC
        'GMD', // Dalasi
        'GEL', // Lari
        'EUR', // Euro
        'GHS', // Ghana Cedi
        'GIP', // Gibraltar Pound
        'EUR', // Euro
        'DKK', // Danish Krone
        'XCD', // East Caribbean Dollar
        'EUR', // Euro
        'USD', // US Dollar
        'GTQ', // Quetzal
        'GBP', // Pound Sterling
        'GNF', // Guinean Franc
        'XOF', // CFA Franc BCEAO
        'GYD', // Guyana Dollar
        'HTG', // Gourde
        'USD', // US Dollar
        'AUD', // Australian Dollar
        'EUR', // Euro
        'HNL', // Lempira
        'HKD', // Hong Kong Dollar
        'HUF', // Forint
        'ISK', // Iceland Krona
        'INR', // Indian Rupee
        'IDR', // Rupiah
        'XDR', // SDR (Special Drawing Right)
        'IRR', // Iranian Rial
        'IQD', // Iraqi Dinar
        'EUR', // Euro
        'GBP', // Pound Sterling
        'ILS', // New Israeli Sheqel
        'EUR', // Euro
        'JMD', // Jamaican Dollar
        'JPY', // Yen
        'GBP', // Pound Sterling
        'JOD', // Jordanian Dinar
        'KZT', // Tenge
        'KES', // Kenyan Shilling
        'AUD', // Australian Dollar
        'KPW', // North Korean Won
        'KRW', // Won
        'KWD', // Kuwaiti Dinar
        'KGS', // Som
        'LAK', // Lao Kip
        'EUR', // Euro
        'LBP', // Lebanese Pound
        'LSL', // Loti
        'ZAR', // Rand
        'LRD', // Liberian Dollar
        'LYD', // Libyan Dinar
        'CHF', // Swiss Franc
        'EUR', // Euro
        'EUR', // Euro
        'MOP', // Pataca
        'MKD', // Denar
        'MGA', // Malagasy Ariary
        'MWK', // Malawi Kwacha
        'MYR', // Malaysian Ringgit
        'MVR', // Rufiyaa
        'XOF', // CFA Franc BCEAO
        'EUR', // Euro
        'USD', // US Dollar
        'EUR', // Euro
        'MRU', // Ouguiya
        'MUR', // Mauritius Rupee
        'EUR', // Euro
        'XUA', // ADB Unit of Account
        'MXN', // Mexican Peso
        'MXV', // Mexican Unidad de Inversion (UDI)
        'USD', // US Dollar
        'MDL', // Moldovan Leu
        'EUR', // Euro
        'MNT', // Tugrik
        'EUR', // Euro
        'XCD', // East Caribbean Dollar
        'MAD', // Moroccan Dirham
        'MZN', // Mozambique Metical
        'MMK', // Kyat
        'NAD', // Namibia Dollar
        'ZAR', // Rand
        'AUD', // Australian Dollar
        'NPR', // Nepalese Rupee
        'EUR', // Euro
        'XPF', // CFP Franc
        'NZD', // New Zealand Dollar
        'NIO', // Cordoba Oro
        'XOF', // CFA Franc BCEAO
        'NGN', // Naira
        'NZD', // New Zealand Dollar
        'AUD', // Australian Dollar
        'USD', // US Dollar
        'NOK', // Norwegian Krone
        'OMR', // Rial Omani
        'PKR', // Pakistan Rupee
        'USD', // US Dollar
        '', // No universal currency
        'PAB', // Balboa
        'USD', // US Dollar
        'PGK', // Kina
        'PYG', // Guarani
        'PEN', // Sol
        'PHP', // Philippine Peso
        'NZD', // New Zealand Dollar
        'PLN', // Zloty
        'EUR', // Euro
        'USD', // US Dollar
        'QAR', // Qatari Rial
        'EUR', // Euro
        'RON', // Romanian Leu
        'RUB', // Russian Ruble
        'RWF', // Rwanda Franc
        'EUR', // Euro
        'SHP', // Saint Helena Pound
        'XCD', // East Caribbean Dollar
        'XCD', // East Caribbean Dollar
        'EUR', // Euro
        'EUR', // Euro
        'XCD', // East Caribbean Dollar
        'WST', // Tala
        'EUR', // Euro
        'STN', // Dobra
        'SAR', // Saudi Riyal
        'XOF', // CFA Franc BCEAO
        'RSD', // Serbian Dinar
        'SCR', // Seychelles Rupee
        'SLL', // Leone
        'SGD', // Singapore Dollar
        'ANG', // Netherlands Antillean Guilder
        'XSU', // Sucre
        'EUR', // Euro
        'EUR', // Euro
        'SBD', // Solomon Islands Dollar
        'SOS', // Somali Shilling
        'ZAR', // Rand
        '', // No universal currency
        'SSP', // South Sudanese Pound
        'EUR', // Euro
        'LKR', // Sri Lanka Rupee
        'SDG', // Sudanese Pound
        'SRD', // Surinam Dollar
        'NOK', // Norwegian Krone
        'SZL', // Lilangeni
        'SEK', // Swedish Krona
        'CHF', // Swiss Franc
        'CHE', // WIR Euro
        'CHW', // WIR Franc
        'SYP', // Syrian Pound
        'TWD', // New Taiwan Dollar
        'TJS', // Somoni
        'TZS', // Tanzanian Shilling
        'THB', // Baht
        'USD', // US Dollar
        'XOF', // CFA Franc BCEAO
        'NZD', // New Zealand Dollar
        'TOP', // Pa’anga
        'TTD', // Trinidad and Tobago Dollar
        'TND', // Tunisian Dinar
        'TRY', // Turkish Lira
        'TMT', // Turkmenistan New Manat
        'USD', // US Dollar
        'AUD', // Australian Dollar
        'UGX', // Uganda Shilling
        'UAH', // Hryvnia
        'AED', // UAE Dirham
        'GBP', // Pound Sterling
        'USD', // US Dollar
        'USD', // US Dollar
        'USN', // US Dollar (Next day)
        'UYU', // Peso Uruguayo
        'UYI', // Uruguay Peso en Unidades Indexadas (UI)
        'UYW', // Unidad Previsional
        'UZS', // Uzbekistan Sum
        'VUV', // Vatu
        'VES', // Bolívar Soberano
        'VND', // Dong
        'USD', // US Dollar
        'USD', // US Dollar
        'XPF', // CFP Franc
        'MAD', // Moroccan Dirham
        'YER', // Yemeni Rial
        'ZMW', // Zambian Kwacha
        'ZWL', // Zimbabwe Dollar
        'XBA', // Bond Markets Unit European Composite Unit (EURCO)
        'XBB', // Bond Markets Unit European Monetary Unit (E.M.U.-6)
        'XBC', // Bond Markets Unit European Unit of Account 9 (E.U.A.-9)
        'XBD', // Bond Markets Unit European Unit of Account 17 (E.U.A.-17)
        'XTS', // Codes specifically reserved for testing purposes
        'XXX', // The codes assigned for transactions where no currency is involved
        'XAU', // Gold
        'XPD', // Palladium
        'XPT', // Platinum
        'XAG', // Silver
    ];

    public function validate($input)
    {
        return in_array(strtoupper($input), $this->currencyCodes, true);
    }
}
