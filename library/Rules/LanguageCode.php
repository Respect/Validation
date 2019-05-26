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
 * Validates languages in ISO 639.
 */
class LanguageCode extends AbstractRule
{
    const ALPHA2 = 'alpha-2';
    const ALPHA3 = 'alpha-3';

    /**
     * @link http://www.loc.gov/standards/iso639-2/ISO-639-2_utf-8.txt
     *
     * @var array
     */
    protected $languageCodeList = [
        ['AA', 'AAR'], // Afar
        ['AB', 'ABK'], // Abkhazian
        ['', 'ACE'], // Achinese
        ['', 'ACH'], // Acoli
        ['', 'ADA'], // Adangme
        ['', 'ADY'], // Adyghe; Adygei
        ['', 'AFA'], // Afro-Asiatic languages
        ['', 'AFH'], // Afrihili
        ['AF', 'AFR'], // Afrikaans
        ['', 'AIN'], // Ainu
        ['AK', 'AKA'], // Akan
        ['', 'AKK'], // Akkadian
        ['SQ', 'ALB'], // Albanian
        ['', 'ALE'], // Aleut
        ['', 'ALG'], // Algonquian languages
        ['', 'ALT'], // Southern Altai
        ['AM', 'AMH'], // Amharic
        ['', 'ANG'], // English, Old (ca.450-1100)
        ['', 'ANP'], // Angika
        ['', 'APA'], // Apache languages
        ['AR', 'ARA'], // Arabic
        ['', 'ARC'], // Official Aramaic (700-300 BCE); Imperial Aramaic (700-300 BCE)
        ['AN', 'ARG'], // Aragonese
        ['HY', 'ARM'], // Armenian
        ['', 'ARN'], // Mapudungun; Mapuche
        ['', 'ARP'], // Arapaho
        ['', 'ART'], // Artificial languages
        ['', 'ARW'], // Arawak
        ['AS', 'ASM'], // Assamese
        ['', 'AST'], // Asturian; Bable; Leonese; Asturleonese
        ['', 'ATH'], // Athapascan languages
        ['', 'AUS'], // Australian languages
        ['AV', 'AVA'], // Avaric
        ['AE', 'AVE'], // Avestan
        ['', 'AWA'], // Awadhi
        ['AY', 'AYM'], // Aymara
        ['AZ', 'AZE'], // Azerbaijani
        ['', 'BAD'], // Banda languages
        ['', 'BAI'], // Bamileke languages
        ['BA', 'BAK'], // Bashkir
        ['', 'BAL'], // Baluchi
        ['BM', 'BAM'], // Bambara
        ['', 'BAN'], // Balinese
        ['EU', 'BAQ'], // Basque
        ['', 'BAS'], // Basa
        ['', 'BAT'], // Baltic languages
        ['', 'BEJ'], // Beja; Bedawiyet
        ['BE', 'BEL'], // Belarusian
        ['', 'BEM'], // Bemba
        ['BN', 'BEN'], // Bengali
        ['', 'BER'], // Berber languages
        ['', 'BHO'], // Bhojpuri
        ['BH', 'BIH'], // Bihari languages
        ['', 'BIK'], // Bikol
        ['', 'BIN'], // Bini; Edo
        ['BI', 'BIS'], // Bislama
        ['', 'BLA'], // Siksika
        ['', 'BNT'], // Bantu (Other)
        ['BS', 'BOS'], // Bosnian
        ['', 'BRA'], // Braj
        ['BR', 'BRE'], // Breton
        ['', 'BTK'], // Batak languages
        ['', 'BUA'], // Buriat
        ['', 'BUG'], // Buginese
        ['BG', 'BUL'], // Bulgarian
        ['MY', 'BUR'], // Burmese
        ['', 'BYN'], // Blin; Bilin
        ['', 'CAD'], // Caddo
        ['', 'CAI'], // Central American Indian languages
        ['', 'CAR'], // Galibi Carib
        ['CA', 'CAT'], // Catalan; Valencian
        ['', 'CAU'], // Caucasian languages
        ['', 'CEB'], // Cebuano
        ['', 'CEL'], // Celtic languages
        ['CH', 'CHA'], // Chamorro
        ['', 'CHB'], // Chibcha
        ['CE', 'CHE'], // Chechen
        ['', 'CHG'], // Chagatai
        ['ZH', 'CHI'], // Chinese
        ['', 'CHK'], // Chuukese
        ['', 'CHM'], // Mari
        ['', 'CHN'], // Chinook jargon
        ['', 'CHO'], // Choctaw
        ['', 'CHP'], // Chipewyan; Dene Suline
        ['', 'CHR'], // Cherokee
        ['CU', 'CHU'], // Church Slavic; Old Slavonic; Church Slavonic; Old Bulgarian; Old Church Slavonic
        ['CV', 'CHV'], // Chuvash
        ['', 'CHY'], // Cheyenne
        ['', 'CMC'], // Chamic languages
        ['', 'CNR'], // Montenegrin
        ['', 'COP'], // Coptic
        ['KW', 'COR'], // Cornish
        ['CO', 'COS'], // Corsican
        ['', 'CPE'], // Creoles and pidgins, English based
        ['', 'CPF'], // Creoles and pidgins, French-based 
        ['', 'CPP'], // Creoles and pidgins, Portuguese-based 
        ['CR', 'CRE'], // Cree
        ['', 'CRH'], // Crimean Tatar; Crimean Turkish
        ['', 'CRP'], // Creoles and pidgins 
        ['', 'CSB'], // Kashubian
        ['', 'CUS'], // Cushitic languages
        ['CS', 'CZE'], // Czech
        ['', 'DAK'], // Dakota
        ['DA', 'DAN'], // Danish
        ['', 'DAR'], // Dargwa
        ['', 'DAY'], // Land Dayak languages
        ['', 'DEL'], // Delaware
        ['', 'DEN'], // Slave (Athapascan)
        ['', 'DGR'], // Dogrib
        ['', 'DIN'], // Dinka
        ['DV', 'DIV'], // Divehi; Dhivehi; Maldivian
        ['', 'DOI'], // Dogri
        ['', 'DRA'], // Dravidian languages
        ['', 'DSB'], // Lower Sorbian
        ['', 'DUA'], // Duala
        ['', 'DUM'], // Dutch, Middle (ca.1050-1350)
        ['NL', 'DUT'], // Dutch; Flemish
        ['', 'DYU'], // Dyula
        ['DZ', 'DZO'], // Dzongkha
        ['', 'EFI'], // Efik
        ['', 'EGY'], // Egyptian (Ancient)
        ['', 'EKA'], // Ekajuk
        ['', 'ELX'], // Elamite
        ['EN', 'ENG'], // English
        ['', 'ENM'], // English, Middle (1100-1500)
        ['EO', 'EPO'], // Esperanto
        ['ET', 'EST'], // Estonian
        ['EE', 'EWE'], // Ewe
        ['', 'EWO'], // Ewondo
        ['', 'FAN'], // Fang
        ['FO', 'FAO'], // Faroese
        ['', 'FAT'], // Fanti
        ['FJ', 'FIJ'], // Fijian
        ['', 'FIL'], // Filipino; Pilipino
        ['FI', 'FIN'], // Finnish
        ['', 'FIU'], // Finno-Ugrian languages
        ['', 'FON'], // Fon
        ['FR', 'FRE'], // French
        ['', 'FRM'], // French, Middle (ca.1400-1600)
        ['', 'FRO'], // French, Old (842-ca.1400)
        ['', 'FRR'], // Northern Frisian
        ['', 'FRS'], // Eastern Frisian
        ['FY', 'FRY'], // Western Frisian
        ['FF', 'FUL'], // Fulah
        ['', 'FUR'], // Friulian
        ['', 'GAA'], // Ga
        ['', 'GAY'], // Gayo
        ['', 'GBA'], // Gbaya
        ['', 'GEM'], // Germanic languages
        ['KA', 'GEO'], // Georgian
        ['DE', 'GER'], // German
        ['', 'GEZ'], // Geez
        ['', 'GIL'], // Gilbertese
        ['GD', 'GLA'], // Gaelic; Scottish Gaelic
        ['GA', 'GLE'], // Irish
        ['GL', 'GLG'], // Galician
        ['GV', 'GLV'], // Manx
        ['', 'GMH'], // German, Middle High (ca.1050-1500)
        ['', 'GOH'], // German, Old High (ca.750-1050)
        ['', 'GON'], // Gondi
        ['', 'GOR'], // Gorontalo
        ['', 'GOT'], // Gothic
        ['', 'GRB'], // Grebo
        ['', 'GRC'], // Greek, Ancient (to 1453)
        ['EL', 'GRE'], // Greek, Modern (1453-)
        ['GN', 'GRN'], // Guarani
        ['', 'GSW'], // Swiss German; Alemannic; Alsatian
        ['GU', 'GUJ'], // Gujarati
        ['', 'GWI'], // Gwich'in
        ['', 'HAI'], // Haida
        ['HT', 'HAT'], // Haitian; Haitian Creole
        ['HA', 'HAU'], // Hausa
        ['', 'HAW'], // Hawaiian
        ['HE', 'HEB'], // Hebrew
        ['HZ', 'HER'], // Herero
        ['', 'HIL'], // Hiligaynon
        ['', 'HIM'], // Himachali languages; Western Pahari languages
        ['HI', 'HIN'], // Hindi
        ['', 'HIT'], // Hittite
        ['', 'HMN'], // Hmong; Mong
        ['HO', 'HMO'], // Hiri Motu
        ['HR', 'HRV'], // Croatian
        ['', 'HSB'], // Upper Sorbian
        ['HU', 'HUN'], // Hungarian
        ['', 'HUP'], // Hupa
        ['', 'IBA'], // Iban
        ['IG', 'IBO'], // Igbo
        ['IS', 'ICE'], // Icelandic
        ['IO', 'IDO'], // Ido
        ['II', 'III'], // Sichuan Yi; Nuosu
        ['', 'IJO'], // Ijo languages
        ['IU', 'IKU'], // Inuktitut
        ['IE', 'ILE'], // Interlingue; Occidental
        ['', 'ILO'], // Iloko
        ['IA', 'INA'], // Interlingua (International Auxiliary Language Association)
        ['', 'INC'], // Indic languages
        ['ID', 'IND'], // Indonesian
        ['', 'INE'], // Indo-European languages
        ['', 'INH'], // Ingush
        ['IK', 'IPK'], // Inupiaq
        ['', 'IRA'], // Iranian languages
        ['', 'IRO'], // Iroquoian languages
        ['IT', 'ITA'], // Italian
        ['JV', 'JAV'], // Javanese
        ['', 'JBO'], // Lojban
        ['JA', 'JPN'], // Japanese
        ['', 'JPR'], // Judeo-Persian
        ['', 'JRB'], // Judeo-Arabic
        ['', 'KAA'], // Kara-Kalpak
        ['', 'KAB'], // Kabyle
        ['', 'KAC'], // Kachin; Jingpho
        ['KL', 'KAL'], // Kalaallisut; Greenlandic
        ['', 'KAM'], // Kamba
        ['KN', 'KAN'], // Kannada
        ['', 'KAR'], // Karen languages
        ['KS', 'KAS'], // Kashmiri
        ['KR', 'KAU'], // Kanuri
        ['', 'KAW'], // Kawi
        ['KK', 'KAZ'], // Kazakh
        ['', 'KBD'], // Kabardian
        ['', 'KHA'], // Khasi
        ['', 'KHI'], // Khoisan languages
        ['KM', 'KHM'], // Central Khmer
        ['', 'KHO'], // Khotanese; Sakan
        ['KI', 'KIK'], // Kikuyu; Gikuyu
        ['RW', 'KIN'], // Kinyarwanda
        ['KY', 'KIR'], // Kirghiz; Kyrgyz
        ['', 'KMB'], // Kimbundu
        ['', 'KOK'], // Konkani
        ['KV', 'KOM'], // Komi
        ['KG', 'KON'], // Kongo
        ['KO', 'KOR'], // Korean
        ['', 'KOS'], // Kosraean
        ['', 'KPE'], // Kpelle
        ['', 'KRC'], // Karachay-Balkar
        ['', 'KRL'], // Karelian
        ['', 'KRO'], // Kru languages
        ['', 'KRU'], // Kurukh
        ['KJ', 'KUA'], // Kuanyama; Kwanyama
        ['', 'KUM'], // Kumyk
        ['KU', 'KUR'], // Kurdish
        ['', 'KUT'], // Kutenai
        ['', 'LAD'], // Ladino
        ['', 'LAH'], // Lahnda
        ['', 'LAM'], // Lamba
        ['LO', 'LAO'], // Lao
        ['LA', 'LAT'], // Latin
        ['LV', 'LAV'], // Latvian
        ['', 'LEZ'], // Lezghian
        ['LI', 'LIM'], // Limburgan; Limburger; Limburgish
        ['LN', 'LIN'], // Lingala
        ['LT', 'LIT'], // Lithuanian
        ['', 'LOL'], // Mongo
        ['', 'LOZ'], // Lozi
        ['LB', 'LTZ'], // Luxembourgish; Letzeburgesch
        ['', 'LUA'], // Luba-Lulua
        ['LU', 'LUB'], // Luba-Katanga
        ['LG', 'LUG'], // Ganda
        ['', 'LUI'], // Luiseno
        ['', 'LUN'], // Lunda
        ['', 'LUO'], // Luo (Kenya and Tanzania)
        ['', 'LUS'], // Lushai
        ['MK', 'MAC'], // Macedonian
        ['', 'MAD'], // Madurese
        ['', 'MAG'], // Magahi
        ['MH', 'MAH'], // Marshallese
        ['', 'MAI'], // Maithili
        ['', 'MAK'], // Makasar
        ['ML', 'MAL'], // Malayalam
        ['', 'MAN'], // Mandingo
        ['MI', 'MAO'], // Maori
        ['', 'MAP'], // Austronesian languages
        ['MR', 'MAR'], // Marathi
        ['', 'MAS'], // Masai
        ['MS', 'MAY'], // Malay
        ['', 'MDF'], // Moksha
        ['', 'MDR'], // Mandar
        ['', 'MEN'], // Mende
        ['', 'MGA'], // Irish, Middle (900-1200)
        ['', 'MIC'], // Mi'kmaq; Micmac
        ['', 'MIN'], // Minangkabau
        ['', 'MIS'], // Uncoded languages
        ['', 'MKH'], // Mon-Khmer languages
        ['MG', 'MLG'], // Malagasy
        ['MT', 'MLT'], // Maltese
        ['', 'MNC'], // Manchu
        ['', 'MNI'], // Manipuri
        ['', 'MNO'], // Manobo languages
        ['', 'MOH'], // Mohawk
        ['MN', 'MON'], // Mongolian
        ['', 'MOS'], // Mossi
        ['', 'MUL'], // Multiple languages
        ['', 'MUN'], // Munda languages
        ['', 'MUS'], // Creek
        ['', 'MWL'], // Mirandese
        ['', 'MWR'], // Marwari
        ['', 'MYN'], // Mayan languages
        ['', 'MYV'], // Erzya
        ['', 'NAH'], // Nahuatl languages
        ['', 'NAI'], // North American Indian languages
        ['', 'NAP'], // Neapolitan
        ['NA', 'NAU'], // Nauru
        ['NV', 'NAV'], // Navajo; Navaho
        ['NR', 'NBL'], // Ndebele, South; South Ndebele
        ['ND', 'NDE'], // Ndebele, North; North Ndebele
        ['NG', 'NDO'], // Ndonga
        ['', 'NDS'], // Low German; Low Saxon; German, Low; Saxon, Low
        ['NE', 'NEP'], // Nepali
        ['', 'NEW'], // Nepal Bhasa; Newari
        ['', 'NIA'], // Nias
        ['', 'NIC'], // Niger-Kordofanian languages
        ['', 'NIU'], // Niuean
        ['NN', 'NNO'], // Norwegian Nynorsk; Nynorsk, Norwegian
        ['NB', 'NOB'], // Bokmål, Norwegian; Norwegian Bokmål
        ['', 'NOG'], // Nogai
        ['', 'NON'], // Norse, Old
        ['NO', 'NOR'], // Norwegian
        ['', 'NQO'], // N'Ko
        ['', 'NSO'], // Pedi; Sepedi; Northern Sotho
        ['', 'NUB'], // Nubian languages
        ['', 'NWC'], // Classical Newari; Old Newari; Classical Nepal Bhasa
        ['NY', 'NYA'], // Chichewa; Chewa; Nyanja
        ['', 'NYM'], // Nyamwezi
        ['', 'NYN'], // Nyankole
        ['', 'NYO'], // Nyoro
        ['', 'NZI'], // Nzima
        ['OC', 'OCI'], // Occitan (post 1500); Provençal
        ['OJ', 'OJI'], // Ojibwa
        ['OR', 'ORI'], // Oriya
        ['OM', 'ORM'], // Oromo
        ['', 'OSA'], // Osage
        ['OS', 'OSS'], // Ossetian; Ossetic
        ['', 'OTA'], // Turkish, Ottoman (1500-1928)
        ['', 'OTO'], // Otomian languages
        ['', 'PAA'], // Papuan languages
        ['', 'PAG'], // Pangasinan
        ['', 'PAL'], // Pahlavi
        ['', 'PAM'], // Pampanga; Kapampangan
        ['PA', 'PAN'], // Panjabi; Punjabi
        ['', 'PAP'], // Papiamento
        ['', 'PAU'], // Palauan
        ['', 'PEO'], // Persian, Old (ca.600-400 B.C.)
        ['FA', 'PER'], // Persian
        ['', 'PHI'], // Philippine languages
        ['', 'PHN'], // Phoenician
        ['PI', 'PLI'], // Pali
        ['PL', 'POL'], // Polish
        ['', 'PON'], // Pohnpeian
        ['PT', 'POR'], // Portuguese
        ['', 'PRA'], // Prakrit languages
        ['', 'PRO'], // Provençal, Old (to 1500)
        ['PS', 'PUS'], // Pushto; Pashto
        ['', 'QAAQTZ'], // Reserved for local use
        ['QU', 'QUE'], // Quechua
        ['', 'RAJ'], // Rajasthani
        ['', 'RAP'], // Rapanui
        ['', 'RAR'], // Rarotongan; Cook Islands Maori
        ['', 'ROA'], // Romance languages
        ['RM', 'ROH'], // Romansh
        ['', 'ROM'], // Romany
        ['RO', 'RUM'], // Romanian; Moldavian; Moldovan
        ['RN', 'RUN'], // Rundi
        ['', 'RUP'], // Aromanian; Arumanian; Macedo-Romanian
        ['RU', 'RUS'], // Russian
        ['', 'SAD'], // Sandawe
        ['SG', 'SAG'], // Sango
        ['', 'SAH'], // Yakut
        ['', 'SAI'], // South American Indian (Other)
        ['', 'SAL'], // Salishan languages
        ['', 'SAM'], // Samaritan Aramaic
        ['SA', 'SAN'], // Sanskrit
        ['', 'SAS'], // Sasak
        ['', 'SAT'], // Santali
        ['', 'SCN'], // Sicilian
        ['', 'SCO'], // Scots
        ['', 'SEL'], // Selkup
        ['', 'SEM'], // Semitic languages
        ['', 'SGA'], // Irish, Old (to 900)
        ['', 'SGN'], // Sign Languages
        ['', 'SHN'], // Shan
        ['', 'SID'], // Sidamo
        ['SI', 'SIN'], // Sinhala; Sinhalese
        ['', 'SIO'], // Siouan languages
        ['', 'SIT'], // Sino-Tibetan languages
        ['', 'SLA'], // Slavic languages
        ['SK', 'SLO'], // Slovak
        ['SL', 'SLV'], // Slovenian
        ['', 'SMA'], // Southern Sami
        ['SE', 'SME'], // Northern Sami
        ['', 'SMI'], // Sami languages
        ['', 'SMJ'], // Lule Sami
        ['', 'SMN'], // Inari Sami
        ['SM', 'SMO'], // Samoan
        ['', 'SMS'], // Skolt Sami
        ['SN', 'SNA'], // Shona
        ['SD', 'SND'], // Sindhi
        ['', 'SNK'], // Soninke
        ['', 'SOG'], // Sogdian
        ['SO', 'SOM'], // Somali
        ['', 'SON'], // Songhai languages
        ['ST', 'SOT'], // Sotho, Southern
        ['ES', 'SPA'], // Spanish; Castilian
        ['SC', 'SRD'], // Sardinian
        ['', 'SRN'], // Sranan Tongo
        ['SR', 'SRP'], // Serbian
        ['', 'SRR'], // Serer
        ['', 'SSA'], // Nilo-Saharan languages
        ['SS', 'SSW'], // Swati
        ['', 'SUK'], // Sukuma
        ['SU', 'SUN'], // Sundanese
        ['', 'SUS'], // Susu
        ['', 'SUX'], // Sumerian
        ['SW', 'SWA'], // Swahili
        ['SV', 'SWE'], // Swedish
        ['', 'SYC'], // Classical Syriac
        ['', 'SYR'], // Syriac
        ['TY', 'TAH'], // Tahitian
        ['', 'TAI'], // Tai languages
        ['TA', 'TAM'], // Tamil
        ['TT', 'TAT'], // Tatar
        ['TE', 'TEL'], // Telugu
        ['', 'TEM'], // Timne
        ['', 'TER'], // Tereno
        ['', 'TET'], // Tetum
        ['TG', 'TGK'], // Tajik
        ['TL', 'TGL'], // Tagalog
        ['TH', 'THA'], // Thai
        ['BO', 'TIB'], // Tibetan
        ['', 'TIG'], // Tigre
        ['TI', 'TIR'], // Tigrinya
        ['', 'TIV'], // Tiv
        ['', 'TKL'], // Tokelau
        ['', 'TLH'], // Klingon; tlhIngan-Hol
        ['', 'TLI'], // Tlingit
        ['', 'TMH'], // Tamashek
        ['', 'TOG'], // Tonga (Nyasa)
        ['TO', 'TON'], // Tonga (Tonga Islands)
        ['', 'TPI'], // Tok Pisin
        ['', 'TSI'], // Tsimshian
        ['TN', 'TSN'], // Tswana
        ['TS', 'TSO'], // Tsonga
        ['TK', 'TUK'], // Turkmen
        ['', 'TUM'], // Tumbuka
        ['', 'TUP'], // Tupi languages
        ['TR', 'TUR'], // Turkish
        ['', 'TUT'], // Altaic languages
        ['', 'TVL'], // Tuvalu
        ['TW', 'TWI'], // Twi
        ['', 'TYV'], // Tuvinian
        ['', 'UDM'], // Udmurt
        ['', 'UGA'], // Ugaritic
        ['UG', 'UIG'], // Uighur; Uyghur
        ['UK', 'UKR'], // Ukrainian
        ['', 'UMB'], // Umbundu
        ['', 'UND'], // Undetermined
        ['UR', 'URD'], // Urdu
        ['UZ', 'UZB'], // Uzbek
        ['', 'VAI'], // Vai
        ['VE', 'VEN'], // Venda
        ['VI', 'VIE'], // Vietnamese
        ['VO', 'VOL'], // Volapük
        ['', 'VOT'], // Votic
        ['', 'WAK'], // Wakashan languages
        ['', 'WAL'], // Walamo
        ['', 'WAR'], // Waray
        ['', 'WAS'], // Washo
        ['CY', 'WEL'], // Welsh
        ['', 'WEN'], // Sorbian languages
        ['WA', 'WLN'], // Walloon
        ['WO', 'WOL'], // Wolof
        ['', 'XAL'], // Kalmyk; Oirat
        ['XH', 'XHO'], // Xhosa
        ['', 'YAO'], // Yao
        ['', 'YAP'], // Yapese
        ['YI', 'YID'], // Yiddish
        ['YO', 'YOR'], // Yoruba
        ['', 'YPK'], // Yupik languages
        ['', 'ZAP'], // Zapotec
        ['', 'ZBL'], // Blissymbols; Blissymbolics; Bliss
        ['', 'ZEN'], // Zenaga
        ['', 'ZGH'], // Standard Moroccan Tamazight
        ['ZA', 'ZHA'], // Zhuang; Chuang
        ['', 'ZND'], // Zande languages
        ['ZU', 'ZUL'], // Zulu
        ['', 'ZUN'], // Zuni
        ['', 'ZXX'], // No linguistic content; Not applicable
    ];

    public $set;
    public $index;

    public function __construct($set = self::ALPHA2)
    {
        $index = array_search($set, self::getAvailableSets(), true);

        if (false === $index) {
            throw new ComponentException(sprintf('"%s" is not a valid language set for ISO 639', $set));
        }

        $this->set = $set;
        $this->index = $index;
    }

    public static function getAvailableSets()
    {
        return [
            self::ALPHA2,
            self::ALPHA3,
        ];
    }

    private function getLanguageCodeList($index)
    {
        $languageList = [];

        foreach ($this->languageCodeList as $language) {
            $languageList[] = $language[$index];
        }

        return $languageList;
    }

    public function validate($input)
    {
        if (!is_string($input) || '' === $input) {
            return false;
        }

        return in_array(
            strtoupper($input),
            $this->getLanguageCodeList($this->index),
            true
        );
    }
}
