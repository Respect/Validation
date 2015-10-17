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

use Respect\Validation\Exceptions\ComponentException;

/**
 * Validates countries in ISO 3166-1.
 */
class CountryCode extends AbstractSearcher
{
    const ALPHA2  = 'alpha-2';
    const ALPHA3  = 'alpha-3';
    const NUMERIC = 'numeric';

    /**
     * @link http://download.geonames.org/export/dump/countryInfo.txt
     *
     * @var array
     */
    protected $countryCodeList = array(
        array('AD', 'AND', '020'), // Andorra
        array('AE', 'ARE', '784'), // United Arab Emirates
        array('AF', 'AFG', '004'), // Afghanistan
        array('AG', 'ATG', '028'), // Antigua and Barbuda
        array('AI', 'AIA', '660'), // Anguilla
        array('AL', 'ALB', '008'), // Albania
        array('AM', 'ARM', '051'), // Armenia
        array('AN', 'ANT', '530'), // Netherlands Antilles
        array('AO', 'AGO', '024'), // Angola
        array('AQ', 'ATA', '010'), // Antarctica
        array('AR', 'ARG', '032'), // Argentina
        array('AS', 'ASM', '016'), // American Samoa
        array('AT', 'AUT', '040'), // Austria
        array('AU', 'AUS', '036'), // Australia
        array('AW', 'ABW', '533'), // Aruba
        array('AX', 'ALA', '248'), // Aland Islands
        array('AZ', 'AZE', '031'), // Azerbaijan
        array('BA', 'BIH', '070'), // Bosnia and Herzegovina
        array('BB', 'BRB', '052'), // Barbados
        array('BD', 'BGD', '050'), // Bangladesh
        array('BE', 'BEL', '056'), // Belgium
        array('BF', 'BFA', '854'), // Burkina Faso
        array('BG', 'BGR', '100'), // Bulgaria
        array('BH', 'BHR', '048'), // Bahrain
        array('BI', 'BDI', '108'), // Burundi
        array('BJ', 'BEN', '204'), // Benin
        array('BL', 'BLM', '652'), // Saint Barthelemy
        array('BM', 'BMU', '060'), // Bermuda
        array('BN', 'BRN', '096'), // Brunei
        array('BO', 'BOL', '068'), // Bolivia
        array('BQ', 'BES', '535'), // Bonaire, Saint Eustatius and Saba
        array('BR', 'BRA', '076'), // Brazil
        array('BS', 'BHS', '044'), // Bahamas
        array('BT', 'BTN', '064'), // Bhutan
        array('BV', 'BVT', '074'), // Bouvet Island
        array('BW', 'BWA', '072'), // Botswana
        array('BY', 'BLR', '112'), // Belarus
        array('BZ', 'BLZ', '084'), // Belize
        array('CA', 'CAN', '124'), // Canada
        array('CC', 'CCK', '166'), // Cocos Islands
        array('CD', 'COD', '180'), // Democratic Republic of the Congo
        array('CF', 'CAF', '140'), // Central African Republic
        array('CG', 'COG', '178'), // Republic of the Congo
        array('CH', 'CHE', '756'), // Switzerland
        array('CI', 'CIV', '384'), // Ivory Coast
        array('CK', 'COK', '184'), // Cook Islands
        array('CL', 'CHL', '152'), // Chile
        array('CM', 'CMR', '120'), // Cameroon
        array('CN', 'CHN', '156'), // China
        array('CO', 'COL', '170'), // Colombia
        array('CR', 'CRI', '188'), // Costa Rica
        array('CS', 'SCG', '891'), // Serbia and Montenegro
        array('CU', 'CUB', '192'), // Cuba
        array('CV', 'CPV', '132'), // Cape Verde
        array('CW', 'CUW', '531'), // Curacao
        array('CX', 'CXR', '162'), // Christmas Island
        array('CY', 'CYP', '196'), // Cyprus
        array('CZ', 'CZE', '203'), // Czech Republic
        array('DE', 'DEU', '276'), // Germany
        array('DJ', 'DJI', '262'), // Djibouti
        array('DK', 'DNK', '208'), // Denmark
        array('DM', 'DMA', '212'), // Dominica
        array('DO', 'DOM', '214'), // Dominican Republic
        array('DZ', 'DZA', '012'), // Algeria
        array('EC', 'ECU', '218'), // Ecuador
        array('EE', 'EST', '233'), // Estonia
        array('EG', 'EGY', '818'), // Egypt
        array('EH', 'ESH', '732'), // Western Sahara
        array('ER', 'ERI', '232'), // Eritrea
        array('ES', 'ESP', '724'), // Spain
        array('ET', 'ETH', '231'), // Ethiopia
        array('FI', 'FIN', '246'), // Finland
        array('FJ', 'FJI', '242'), // Fiji
        array('FK', 'FLK', '238'), // Falkland Islands
        array('FM', 'FSM', '583'), // Micronesia
        array('FO', 'FRO', '234'), // Faroe Islands
        array('FR', 'FRA', '250'), // France
        array('GA', 'GAB', '266'), // Gabon
        array('GB', 'GBR', '826'), // United Kingdom
        array('GD', 'GRD', '308'), // Grenada
        array('GE', 'GEO', '268'), // Georgia
        array('GF', 'GUF', '254'), // French Guiana
        array('GG', 'GGY', '831'), // Guernsey
        array('GH', 'GHA', '288'), // Ghana
        array('GI', 'GIB', '292'), // Gibraltar
        array('GL', 'GRL', '304'), // Greenland
        array('GM', 'GMB', '270'), // Gambia
        array('GN', 'GIN', '324'), // Guinea
        array('GP', 'GLP', '312'), // Guadeloupe
        array('GQ', 'GNQ', '226'), // Equatorial Guinea
        array('GR', 'GRC', '300'), // Greece
        array('GS', 'SGS', '239'), // South Georgia and the South Sandwich Islands
        array('GT', 'GTM', '320'), // Guatemala
        array('GU', 'GUM', '316'), // Guam
        array('GW', 'GNB', '624'), // Guinea-Bissau
        array('GY', 'GUY', '328'), // Guyana
        array('HK', 'HKG', '344'), // Hong Kong
        array('HM', 'HMD', '334'), // Heard Island and McDonald Islands
        array('HN', 'HND', '340'), // Honduras
        array('HR', 'HRV', '191'), // Croatia
        array('HT', 'HTI', '332'), // Haiti
        array('HU', 'HUN', '348'), // Hungary
        array('ID', 'IDN', '360'), // Indonesia
        array('IE', 'IRL', '372'), // Ireland
        array('IL', 'ISR', '376'), // Israel
        array('IM', 'IMN', '833'), // Isle of Man
        array('IN', 'IND', '356'), // India
        array('IO', 'IOT', '086'), // British Indian Ocean Territory
        array('IQ', 'IRQ', '368'), // Iraq
        array('IR', 'IRN', '364'), // Iran
        array('IS', 'ISL', '352'), // Iceland
        array('IT', 'ITA', '380'), // Italy
        array('JE', 'JEY', '832'), // Jersey
        array('JM', 'JAM', '388'), // Jamaica
        array('JO', 'JOR', '400'), // Jordan
        array('JP', 'JPN', '392'), // Japan
        array('KE', 'KEN', '404'), // Kenya
        array('KG', 'KGZ', '417'), // Kyrgyzstan
        array('KH', 'KHM', '116'), // Cambodia
        array('KI', 'KIR', '296'), // Kiribati
        array('KM', 'COM', '174'), // Comoros
        array('KN', 'KNA', '659'), // Saint Kitts and Nevis
        array('KP', 'PRK', '408'), // North Korea
        array('KR', 'KOR', '410'), // South Korea
        array('KW', 'KWT', '414'), // Kuwait
        array('KY', 'CYM', '136'), // Cayman Islands
        array('KZ', 'KAZ', '398'), // Kazakhstan
        array('LA', 'LAO', '418'), // Laos
        array('LB', 'LBN', '422'), // Lebanon
        array('LC', 'LCA', '662'), // Saint Lucia
        array('LI', 'LIE', '438'), // Liechtenstein
        array('LK', 'LKA', '144'), // Sri Lanka
        array('LR', 'LBR', '430'), // Liberia
        array('LS', 'LSO', '426'), // Lesotho
        array('LT', 'LTU', '440'), // Lithuania
        array('LU', 'LUX', '442'), // Luxembourg
        array('LV', 'LVA', '428'), // Latvia
        array('LY', 'LBY', '434'), // Libya
        array('MA', 'MAR', '504'), // Morocco
        array('MC', 'MCO', '492'), // Monaco
        array('MD', 'MDA', '498'), // Moldova
        array('ME', 'MNE', '499'), // Montenegro
        array('MF', 'MAF', '663'), // Saint Martin
        array('MG', 'MDG', '450'), // Madagascar
        array('MH', 'MHL', '584'), // Marshall Islands
        array('MK', 'MKD', '807'), // Macedonia
        array('ML', 'MLI', '466'), // Mali
        array('MM', 'MMR', '104'), // Myanmar
        array('MN', 'MNG', '496'), // Mongolia
        array('MO', 'MAC', '446'), // Macao
        array('MP', 'MNP', '580'), // Northern Mariana Islands
        array('MQ', 'MTQ', '474'), // Martinique
        array('MR', 'MRT', '478'), // Mauritania
        array('MS', 'MSR', '500'), // Montserrat
        array('MT', 'MLT', '470'), // Malta
        array('MU', 'MUS', '480'), // Mauritius
        array('MV', 'MDV', '462'), // Maldives
        array('MW', 'MWI', '454'), // Malawi
        array('MX', 'MEX', '484'), // Mexico
        array('MY', 'MYS', '458'), // Malaysia
        array('MZ', 'MOZ', '508'), // Mozambique
        array('NA', 'NAM', '516'), // Namibia
        array('NC', 'NCL', '540'), // New Caledonia
        array('NE', 'NER', '562'), // Niger
        array('NF', 'NFK', '574'), // Norfolk Island
        array('NG', 'NGA', '566'), // Nigeria
        array('NI', 'NIC', '558'), // Nicaragua
        array('NL', 'NLD', '528'), // Netherlands
        array('NO', 'NOR', '578'), // Norway
        array('NP', 'NPL', '524'), // Nepal
        array('NR', 'NRU', '520'), // Nauru
        array('NU', 'NIU', '570'), // Niue
        array('NZ', 'NZL', '554'), // New Zealand
        array('OM', 'OMN', '512'), // Oman
        array('PA', 'PAN', '591'), // Panama
        array('PE', 'PER', '604'), // Peru
        array('PF', 'PYF', '258'), // French Polynesia
        array('PG', 'PNG', '598'), // Papua New Guinea
        array('PH', 'PHL', '608'), // Philippines
        array('PK', 'PAK', '586'), // Pakistan
        array('PL', 'POL', '616'), // Poland
        array('PM', 'SPM', '666'), // Saint Pierre and Miquelon
        array('PN', 'PCN', '612'), // Pitcairn
        array('PR', 'PRI', '630'), // Puerto Rico
        array('PS', 'PSE', '275'), // Palestinian Territory
        array('PT', 'PRT', '620'), // Portugal
        array('PW', 'PLW', '585'), // Palau
        array('PY', 'PRY', '600'), // Paraguay
        array('QA', 'QAT', '634'), // Qatar
        array('RE', 'REU', '638'), // Reunion
        array('RO', 'ROU', '642'), // Romania
        array('RS', 'SRB', '688'), // Serbia
        array('RU', 'RUS', '643'), // Russia
        array('RW', 'RWA', '646'), // Rwanda
        array('SA', 'SAU', '682'), // Saudi Arabia
        array('SB', 'SLB', '090'), // Solomon Islands
        array('SC', 'SYC', '690'), // Seychelles
        array('SD', 'SDN', '729'), // Sudan
        array('SE', 'SWE', '752'), // Sweden
        array('SG', 'SGP', '702'), // Singapore
        array('SH', 'SHN', '654'), // Saint Helena
        array('SI', 'SVN', '705'), // Slovenia
        array('SJ', 'SJM', '744'), // Svalbard and Jan Mayen
        array('SK', 'SVK', '703'), // Slovakia
        array('SL', 'SLE', '694'), // Sierra Leone
        array('SM', 'SMR', '674'), // San Marino
        array('SN', 'SEN', '686'), // Senegal
        array('SO', 'SOM', '706'), // Somalia
        array('SR', 'SUR', '740'), // Suriname
        array('SS', 'SSD', '728'), // South Sudan
        array('ST', 'STP', '678'), // Sao Tome and Principe
        array('SV', 'SLV', '222'), // El Salvador
        array('SX', 'SXM', '534'), // Sint Maarten
        array('SY', 'SYR', '760'), // Syria
        array('SZ', 'SWZ', '748'), // Swaziland
        array('TC', 'TCA', '796'), // Turks and Caicos Islands
        array('TD', 'TCD', '148'), // Chad
        array('TF', 'ATF', '260'), // French Southern Territories
        array('TG', 'TGO', '768'), // Togo
        array('TH', 'THA', '764'), // Thailand
        array('TJ', 'TJK', '762'), // Tajikistan
        array('TK', 'TKL', '772'), // Tokelau
        array('TL', 'TLS', '626'), // East Timor
        array('TM', 'TKM', '795'), // Turkmenistan
        array('TN', 'TUN', '788'), // Tunisia
        array('TO', 'TON', '776'), // Tonga
        array('TR', 'TUR', '792'), // Turkey
        array('TT', 'TTO', '780'), // Trinidad and Tobago
        array('TV', 'TUV', '798'), // Tuvalu
        array('TW', 'TWN', '158'), // Taiwan
        array('TZ', 'TZA', '834'), // Tanzania
        array('UA', 'UKR', '804'), // Ukraine
        array('UG', 'UGA', '800'), // Uganda
        array('UM', 'UMI', '581'), // United States Minor Outlying Islands
        array('US', 'USA', '840'), // United States
        array('UY', 'URY', '858'), // Uruguay
        array('UZ', 'UZB', '860'), // Uzbekistan
        array('VA', 'VAT', '336'), // Vatican
        array('VC', 'VCT', '670'), // Saint Vincent and the Grenadines
        array('VE', 'VEN', '862'), // Venezuela
        array('VG', 'VGB', '092'), // British Virgin Islands
        array('VI', 'VIR', '850'), // U.S. Virgin Islands
        array('VN', 'VNM', '704'), // Vietnam
        array('VU', 'VUT', '548'), // Vanuatu
        array('WF', 'WLF', '876'), // Wallis and Futuna
        array('WS', 'WSM', '882'), // Samoa
        array('XK', 'XKX', '0'), // Kosovo
        array('YE', 'YEM', '887'), // Yemen
        array('YT', 'MYT', '175'), // Mayotte
        array('ZA', 'ZAF', '710'), // South Africa
        array('ZM', 'ZMB', '894'), // Zambia
        array('ZW', 'ZWE', '716'), // Zimbabwe

    );

    public $set;
    public $index;

    public function __construct($set = self::ALPHA2)
    {
        $index = array_search($set, self::getAvailableSets(), true);
        if (false === $index) {
            throw new ComponentException(sprintf('"%s" is not a valid country set for ISO 3166-1', $set));
        }

        $this->set   = $set;
        $this->index = $index;
    }

    public static function getAvailableSets()
    {
        return array(
            self::ALPHA2,
            self::ALPHA3,
            self::NUMERIC,
        );
    }

    private function getCountryCodeList($index)
    {
        $countryList = array();
        foreach ($this->countryCodeList as $country) {
            $countryList[] = $country[$index];
        }

        return $countryList;
    }

    public function validate($input)
    {
        return in_array(
            strtoupper($input),
            $this->getCountryCodeList($this->index),
            true
        );
    }
}
