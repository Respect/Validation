<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates currency codes in ISO 4217.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Justin Hook <justinhook88@yahoo.co.uk>
 * @author Tim Strijdhorst <tstrijdhorst@users.noreply.github.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CurrencyCode extends AbstractSearcher
{
    /**
     * @see http://www.currency-iso.org/en/home/tables/table-a1.html
     *
     * {@inheritDoc}
     *
     * @return string[]
     */
    protected function getDataSource($input = null): array
    {
        return [
            'AED', // UAE Dirham
            'AFN', // Afghani
            'ALL', // Lek
            'AMD', // Armenian Dram
            'ANG', // Netherlands Antillean Guilder
            'AOA', // Kwanza
            'ARS', // Argentine Peso
            'AUD', // Australian Dollar
            'AWG', // Aruban Florin
            'AZN', // Azerbaijan Manat
            'BAM', // Convertible Mark
            'BBD', // Barbados Dollar
            'BDT', // Taka
            'BGN', // Bulgarian Lev
            'BHD', // Bahraini Dinar
            'BIF', // Burundi Franc
            'BMD', // Bermudian Dollar
            'BND', // Brunei Dollar
            'BOB', // Boliviano
            'BOV', // Mvdol
            'BRL', // Brazilian Real
            'BSD', // Bahamian Dollar
            'BTN', // Ngultrum
            'BWP', // Pula
            'BYN', // Belarusian Ruble
            'BZD', // Belize Dollar
            'CAD', // Canadian Dollar
            'CDF', // Congolese Franc
            'CHE', // WIR Euro
            'CHF', // Swiss Franc
            'CHW', // WIR Franc
            'CLF', // Unidad de Fomento
            'CLP', // Chilean Peso
            'CNY', // Yuan Renminbi
            'COP', // Colombian Peso
            'COU', // Unidad de Valor Real
            'CRC', // Costa Rican Colon
            'CUC', // Peso Convertible
            'CUP', // Cuban Peso
            'CVE', // Cabo Verde Escudo
            'CZK', // Czech Koruna
            'DJF', // Djibouti Franc
            'DKK', // Danish Krone
            'DOP', // Dominican Peso
            'DZD', // Algerian Dinar
            'EGP', // Egyptian Pound
            'ERN', // Nakfa
            'ETB', // Ethiopian Birr
            'EUR', // Euro
            'FJD', // Fiji Dollar
            'FKP', // Falkland Islands Pound
            'GBP', // Pound Sterling
            'GEL', // Lari
            'GHS', // Ghana Cedi
            'GIP', // Gibraltar Pound
            'GMD', // Dalasi
            'GNF', // Guinean Franc
            'GTQ', // Quetzal
            'GYD', // Guyana Dollar
            'HKD', // Hong Kong Dollar
            'HNL', // Lempira
            'HTG', // Gourde
            'HUF', // Forint
            'IDR', // Rupiah
            'ILS', // New Israeli Sheqel
            'INR', // Indian Rupee
            'IQD', // Iraqi Dinar
            'IRR', // Iranian Rial
            'ISK', // Iceland Krona
            'JMD', // Jamaican Dollar
            'JOD', // Jordanian Dinar
            'JPY', // Yen
            'KES', // Kenyan Shilling
            'KGS', // Som
            'KHR', // Riel
            'KMF', // Comorian Franc
            'KPW', // North Korean Won
            'KRW', // Won
            'KWD', // Kuwaiti Dinar
            'KYD', // Cayman Islands Dollar
            'KZT', // Tenge
            'LAK', // Lao Kip
            'LBP', // Lebanese Pound
            'LKR', // Sri Lanka Rupee
            'LRD', // Liberian Dollar
            'LSL', // Loti
            'LYD', // Libyan Dinar
            'MAD', // Moroccan Dirham
            'MDL', // Moldovan Leu
            'MGA', // Malagasy Ariary
            'MKD', // Denar
            'MMK', // Kyat
            'MNT', // Tugrik
            'MOP', // Pataca
            'MRU', // Ouguiya
            'MUR', // Mauritius Rupee
            'MVR', // Rufiyaa
            'MWK', // Malawi Kwacha
            'MXN', // Mexican Peso
            'MXV', // Mexican Unidad de Inversion (UDI)
            'MYR', // Malaysian Ringgit
            'MZN', // Mozambique Metical
            'NAD', // Namibia Dollar
            'NGN', // Naira
            'NIO', // Cordoba Oro
            'NOK', // Norwegian Krone
            'NPR', // Nepalese Rupee
            'NZD', // New Zealand Dollar
            'OMR', // Rial Omani
            'PAB', // Balboa
            'PEN', // Sol
            'PGK', // Kina
            'PHP', // Philippine Peso
            'PKR', // Pakistan Rupee
            'PLN', // Zloty
            'PYG', // Guarani
            'QAR', // Qatari Rial
            'RON', // Romanian Leu
            'RSD', // Serbian Dinar
            'RUB', // Russian Ruble
            'RWF', // Rwanda Franc
            'SAR', // Saudi Riyal
            'SBD', // Solomon Islands Dollar
            'SCR', // Seychelles Rupee
            'SDG', // Sudanese Pound
            'SEK', // Swedish Krona
            'SGD', // Singapore Dollar
            'SHP', // Saint Helena Pound
            'SLE', // Leone
            'SOS', // Somali Shilling
            'SRD', // Surinam Dollar
            'SSP', // South Sudanese Pound
            'STN', // Dobra
            'SVC', // El Salvador Colon
            'SYP', // Syrian Pound
            'SZL', // Lilangeni
            'THB', // Baht
            'TJS', // Somoni
            'TMT', // Turkmenistan New Manat
            'TND', // Tunisian Dinar
            'TOP', // Pa’anga
            'TRY', // Turkish Lira
            'TTD', // Trinidad and Tobago Dollar
            'TWD', // New Taiwan Dollar
            'TZS', // Tanzanian Shilling
            'UAH', // Hryvnia
            'UGX', // Uganda Shilling
            'USD', // US Dollar
            'USN', // US Dollar (Next day)
            'UYI', // Uruguay Peso en Unidades Indexadas (UI)
            'UYU', // Peso Uruguayo
            'UYW', // Unidad Previsional
            'UZS', // Uzbekistan Sum
            'VED', // Bolívar Soberano
            'VES', // Bolívar Soberano
            'VND', // Dong
            'VUV', // Vatu
            'WST', // Tala
            'XAF', // CFA Franc BEAC
            'XAG', // Silver
            'XAU', // Gold
            'XBA', // Bond Markets Unit European Composite Unit (EURCO)
            'XBB', // Bond Markets Unit European Monetary Unit (E.M.U.-6)
            'XBC', // Bond Markets Unit European Unit of Account 9 (E.U.A.-9)
            'XBD', // Bond Markets Unit European Unit of Account 17 (E.U.A.-17)
            'XCD', // East Caribbean Dollar
            'XDR', // SDR (Special Drawing Right)
            'XOF', // CFA Franc BCEAO
            'XPD', // Palladium
            'XPF', // CFP Franc
            'XPT', // Platinum
            'XSU', // Sucre
            'XTS', // Codes specifically reserved for testing purposes
            'XUA', // ADB Unit of Account
            'XXX', // The codes assigned for transactions where no currency is involved
            'YER', // Yemeni Rial
            'ZAR', // Rand
            'ZMW', // Zambian Kwacha
            'ZWG', // Zimbabwe Gold
        ];
    }
}
