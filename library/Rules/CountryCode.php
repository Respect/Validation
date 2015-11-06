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
class CountryCode extends AbstractRule
{
    const ALPHA2 = 'alpha-2';
    const ALPHA3 = 'alpha-3';
    const NUMERIC = 'numeric';

    /**
     * @link http://download.geonames.org/export/dump/countryInfo.txt
     *
     * @var array
     */
    protected $countryCodeList = [
        ['AD', 'AND', '020'], // Andorra
        ['AE', 'ARE', '784'], // United Arab Emirates
        ['AF', 'AFG', '004'], // Afghanistan
        ['AG', 'ATG', '028'], // Antigua and Barbuda
        ['AI', 'AIA', '660'], // Anguilla
        ['AL', 'ALB', '008'], // Albania
        ['AM', 'ARM', '051'], // Armenia
        ['AN', 'ANT', '530'], // Netherlands Antilles
        ['AO', 'AGO', '024'], // Angola
        ['AQ', 'ATA', '010'], // Antarctica
        ['AR', 'ARG', '032'], // Argentina
        ['AS', 'ASM', '016'], // American Samoa
        ['AT', 'AUT', '040'], // Austria
        ['AU', 'AUS', '036'], // Australia
        ['AW', 'ABW', '533'], // Aruba
        ['AX', 'ALA', '248'], // Aland Islands
        ['AZ', 'AZE', '031'], // Azerbaijan
        ['BA', 'BIH', '070'], // Bosnia and Herzegovina
        ['BB', 'BRB', '052'], // Barbados
        ['BD', 'BGD', '050'], // Bangladesh
        ['BE', 'BEL', '056'], // Belgium
        ['BF', 'BFA', '854'], // Burkina Faso
        ['BG', 'BGR', '100'], // Bulgaria
        ['BH', 'BHR', '048'], // Bahrain
        ['BI', 'BDI', '108'], // Burundi
        ['BJ', 'BEN', '204'], // Benin
        ['BL', 'BLM', '652'], // Saint Barthelemy
        ['BM', 'BMU', '060'], // Bermuda
        ['BN', 'BRN', '096'], // Brunei
        ['BO', 'BOL', '068'], // Bolivia
        ['BQ', 'BES', '535'], // Bonaire, Saint Eustatius and Saba
        ['BR', 'BRA', '076'], // Brazil
        ['BS', 'BHS', '044'], // Bahamas
        ['BT', 'BTN', '064'], // Bhutan
        ['BV', 'BVT', '074'], // Bouvet Island
        ['BW', 'BWA', '072'], // Botswana
        ['BY', 'BLR', '112'], // Belarus
        ['BZ', 'BLZ', '084'], // Belize
        ['CA', 'CAN', '124'], // Canada
        ['CC', 'CCK', '166'], // Cocos Islands
        ['CD', 'COD', '180'], // Democratic Republic of the Congo
        ['CF', 'CAF', '140'], // Central African Republic
        ['CG', 'COG', '178'], // Republic of the Congo
        ['CH', 'CHE', '756'], // Switzerland
        ['CI', 'CIV', '384'], // Ivory Coast
        ['CK', 'COK', '184'], // Cook Islands
        ['CL', 'CHL', '152'], // Chile
        ['CM', 'CMR', '120'], // Cameroon
        ['CN', 'CHN', '156'], // China
        ['CO', 'COL', '170'], // Colombia
        ['CR', 'CRI', '188'], // Costa Rica
        ['CS', 'SCG', '891'], // Serbia and Montenegro
        ['CU', 'CUB', '192'], // Cuba
        ['CV', 'CPV', '132'], // Cape Verde
        ['CW', 'CUW', '531'], // Curacao
        ['CX', 'CXR', '162'], // Christmas Island
        ['CY', 'CYP', '196'], // Cyprus
        ['CZ', 'CZE', '203'], // Czech Republic
        ['DE', 'DEU', '276'], // Germany
        ['DJ', 'DJI', '262'], // Djibouti
        ['DK', 'DNK', '208'], // Denmark
        ['DM', 'DMA', '212'], // Dominica
        ['DO', 'DOM', '214'], // Dominican Republic
        ['DZ', 'DZA', '012'], // Algeria
        ['EC', 'ECU', '218'], // Ecuador
        ['EE', 'EST', '233'], // Estonia
        ['EG', 'EGY', '818'], // Egypt
        ['EH', 'ESH', '732'], // Western Sahara
        ['ER', 'ERI', '232'], // Eritrea
        ['ES', 'ESP', '724'], // Spain
        ['ET', 'ETH', '231'], // Ethiopia
        ['FI', 'FIN', '246'], // Finland
        ['FJ', 'FJI', '242'], // Fiji
        ['FK', 'FLK', '238'], // Falkland Islands
        ['FM', 'FSM', '583'], // Micronesia
        ['FO', 'FRO', '234'], // Faroe Islands
        ['FR', 'FRA', '250'], // France
        ['GA', 'GAB', '266'], // Gabon
        ['GB', 'GBR', '826'], // United Kingdom
        ['GD', 'GRD', '308'], // Grenada
        ['GE', 'GEO', '268'], // Georgia
        ['GF', 'GUF', '254'], // French Guiana
        ['GG', 'GGY', '831'], // Guernsey
        ['GH', 'GHA', '288'], // Ghana
        ['GI', 'GIB', '292'], // Gibraltar
        ['GL', 'GRL', '304'], // Greenland
        ['GM', 'GMB', '270'], // Gambia
        ['GN', 'GIN', '324'], // Guinea
        ['GP', 'GLP', '312'], // Guadeloupe
        ['GQ', 'GNQ', '226'], // Equatorial Guinea
        ['GR', 'GRC', '300'], // Greece
        ['GS', 'SGS', '239'], // South Georgia and the South Sandwich Islands
        ['GT', 'GTM', '320'], // Guatemala
        ['GU', 'GUM', '316'], // Guam
        ['GW', 'GNB', '624'], // Guinea-Bissau
        ['GY', 'GUY', '328'], // Guyana
        ['HK', 'HKG', '344'], // Hong Kong
        ['HM', 'HMD', '334'], // Heard Island and McDonald Islands
        ['HN', 'HND', '340'], // Honduras
        ['HR', 'HRV', '191'], // Croatia
        ['HT', 'HTI', '332'], // Haiti
        ['HU', 'HUN', '348'], // Hungary
        ['ID', 'IDN', '360'], // Indonesia
        ['IE', 'IRL', '372'], // Ireland
        ['IL', 'ISR', '376'], // Israel
        ['IM', 'IMN', '833'], // Isle of Man
        ['IN', 'IND', '356'], // India
        ['IO', 'IOT', '086'], // British Indian Ocean Territory
        ['IQ', 'IRQ', '368'], // Iraq
        ['IR', 'IRN', '364'], // Iran
        ['IS', 'ISL', '352'], // Iceland
        ['IT', 'ITA', '380'], // Italy
        ['JE', 'JEY', '832'], // Jersey
        ['JM', 'JAM', '388'], // Jamaica
        ['JO', 'JOR', '400'], // Jordan
        ['JP', 'JPN', '392'], // Japan
        ['KE', 'KEN', '404'], // Kenya
        ['KG', 'KGZ', '417'], // Kyrgyzstan
        ['KH', 'KHM', '116'], // Cambodia
        ['KI', 'KIR', '296'], // Kiribati
        ['KM', 'COM', '174'], // Comoros
        ['KN', 'KNA', '659'], // Saint Kitts and Nevis
        ['KP', 'PRK', '408'], // North Korea
        ['KR', 'KOR', '410'], // South Korea
        ['KW', 'KWT', '414'], // Kuwait
        ['KY', 'CYM', '136'], // Cayman Islands
        ['KZ', 'KAZ', '398'], // Kazakhstan
        ['LA', 'LAO', '418'], // Laos
        ['LB', 'LBN', '422'], // Lebanon
        ['LC', 'LCA', '662'], // Saint Lucia
        ['LI', 'LIE', '438'], // Liechtenstein
        ['LK', 'LKA', '144'], // Sri Lanka
        ['LR', 'LBR', '430'], // Liberia
        ['LS', 'LSO', '426'], // Lesotho
        ['LT', 'LTU', '440'], // Lithuania
        ['LU', 'LUX', '442'], // Luxembourg
        ['LV', 'LVA', '428'], // Latvia
        ['LY', 'LBY', '434'], // Libya
        ['MA', 'MAR', '504'], // Morocco
        ['MC', 'MCO', '492'], // Monaco
        ['MD', 'MDA', '498'], // Moldova
        ['ME', 'MNE', '499'], // Montenegro
        ['MF', 'MAF', '663'], // Saint Martin
        ['MG', 'MDG', '450'], // Madagascar
        ['MH', 'MHL', '584'], // Marshall Islands
        ['MK', 'MKD', '807'], // Macedonia
        ['ML', 'MLI', '466'], // Mali
        ['MM', 'MMR', '104'], // Myanmar
        ['MN', 'MNG', '496'], // Mongolia
        ['MO', 'MAC', '446'], // Macao
        ['MP', 'MNP', '580'], // Northern Mariana Islands
        ['MQ', 'MTQ', '474'], // Martinique
        ['MR', 'MRT', '478'], // Mauritania
        ['MS', 'MSR', '500'], // Montserrat
        ['MT', 'MLT', '470'], // Malta
        ['MU', 'MUS', '480'], // Mauritius
        ['MV', 'MDV', '462'], // Maldives
        ['MW', 'MWI', '454'], // Malawi
        ['MX', 'MEX', '484'], // Mexico
        ['MY', 'MYS', '458'], // Malaysia
        ['MZ', 'MOZ', '508'], // Mozambique
        ['NA', 'NAM', '516'], // Namibia
        ['NC', 'NCL', '540'], // New Caledonia
        ['NE', 'NER', '562'], // Niger
        ['NF', 'NFK', '574'], // Norfolk Island
        ['NG', 'NGA', '566'], // Nigeria
        ['NI', 'NIC', '558'], // Nicaragua
        ['NL', 'NLD', '528'], // Netherlands
        ['NO', 'NOR', '578'], // Norway
        ['NP', 'NPL', '524'], // Nepal
        ['NR', 'NRU', '520'], // Nauru
        ['NU', 'NIU', '570'], // Niue
        ['NZ', 'NZL', '554'], // New Zealand
        ['OM', 'OMN', '512'], // Oman
        ['PA', 'PAN', '591'], // Panama
        ['PE', 'PER', '604'], // Peru
        ['PF', 'PYF', '258'], // French Polynesia
        ['PG', 'PNG', '598'], // Papua New Guinea
        ['PH', 'PHL', '608'], // Philippines
        ['PK', 'PAK', '586'], // Pakistan
        ['PL', 'POL', '616'], // Poland
        ['PM', 'SPM', '666'], // Saint Pierre and Miquelon
        ['PN', 'PCN', '612'], // Pitcairn
        ['PR', 'PRI', '630'], // Puerto Rico
        ['PS', 'PSE', '275'], // Palestinian Territory
        ['PT', 'PRT', '620'], // Portugal
        ['PW', 'PLW', '585'], // Palau
        ['PY', 'PRY', '600'], // Paraguay
        ['QA', 'QAT', '634'], // Qatar
        ['RE', 'REU', '638'], // Reunion
        ['RO', 'ROU', '642'], // Romania
        ['RS', 'SRB', '688'], // Serbia
        ['RU', 'RUS', '643'], // Russia
        ['RW', 'RWA', '646'], // Rwanda
        ['SA', 'SAU', '682'], // Saudi Arabia
        ['SB', 'SLB', '090'], // Solomon Islands
        ['SC', 'SYC', '690'], // Seychelles
        ['SD', 'SDN', '729'], // Sudan
        ['SE', 'SWE', '752'], // Sweden
        ['SG', 'SGP', '702'], // Singapore
        ['SH', 'SHN', '654'], // Saint Helena
        ['SI', 'SVN', '705'], // Slovenia
        ['SJ', 'SJM', '744'], // Svalbard and Jan Mayen
        ['SK', 'SVK', '703'], // Slovakia
        ['SL', 'SLE', '694'], // Sierra Leone
        ['SM', 'SMR', '674'], // San Marino
        ['SN', 'SEN', '686'], // Senegal
        ['SO', 'SOM', '706'], // Somalia
        ['SR', 'SUR', '740'], // Suriname
        ['SS', 'SSD', '728'], // South Sudan
        ['ST', 'STP', '678'], // Sao Tome and Principe
        ['SV', 'SLV', '222'], // El Salvador
        ['SX', 'SXM', '534'], // Sint Maarten
        ['SY', 'SYR', '760'], // Syria
        ['SZ', 'SWZ', '748'], // Swaziland
        ['TC', 'TCA', '796'], // Turks and Caicos Islands
        ['TD', 'TCD', '148'], // Chad
        ['TF', 'ATF', '260'], // French Southern Territories
        ['TG', 'TGO', '768'], // Togo
        ['TH', 'THA', '764'], // Thailand
        ['TJ', 'TJK', '762'], // Tajikistan
        ['TK', 'TKL', '772'], // Tokelau
        ['TL', 'TLS', '626'], // East Timor
        ['TM', 'TKM', '795'], // Turkmenistan
        ['TN', 'TUN', '788'], // Tunisia
        ['TO', 'TON', '776'], // Tonga
        ['TR', 'TUR', '792'], // Turkey
        ['TT', 'TTO', '780'], // Trinidad and Tobago
        ['TV', 'TUV', '798'], // Tuvalu
        ['TW', 'TWN', '158'], // Taiwan
        ['TZ', 'TZA', '834'], // Tanzania
        ['UA', 'UKR', '804'], // Ukraine
        ['UG', 'UGA', '800'], // Uganda
        ['UM', 'UMI', '581'], // United States Minor Outlying Islands
        ['US', 'USA', '840'], // United States
        ['UY', 'URY', '858'], // Uruguay
        ['UZ', 'UZB', '860'], // Uzbekistan
        ['VA', 'VAT', '336'], // Vatican
        ['VC', 'VCT', '670'], // Saint Vincent and the Grenadines
        ['VE', 'VEN', '862'], // Venezuela
        ['VG', 'VGB', '092'], // British Virgin Islands
        ['VI', 'VIR', '850'], // U.S. Virgin Islands
        ['VN', 'VNM', '704'], // Vietnam
        ['VU', 'VUT', '548'], // Vanuatu
        ['WF', 'WLF', '876'], // Wallis and Futuna
        ['WS', 'WSM', '882'], // Samoa
        ['XK', 'XKX', '0'], // Kosovo
        ['YE', 'YEM', '887'], // Yemen
        ['YT', 'MYT', '175'], // Mayotte
        ['ZA', 'ZAF', '710'], // South Africa
        ['ZM', 'ZMB', '894'], // Zambia
        ['ZW', 'ZWE', '716'], // Zimbabwe

    ];

    public $set;
    public $index;

    public function __construct($set = self::ALPHA2)
    {
        $index = array_search($set, self::getAvailableSets(), true);
        if (false === $index) {
            throw new ComponentException(sprintf('"%s" is not a valid country set for ISO 3166-1', $set));
        }

        $this->set = $set;
        $this->index = $index;
    }

    public static function getAvailableSets()
    {
        return [
            self::ALPHA2,
            self::ALPHA3,
            self::NUMERIC,
        ];
    }

    private function getCountryCodeList($index)
    {
        $countryList = [];
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
