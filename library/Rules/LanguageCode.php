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
        ['AA', '﻿AAR'], // AFAR
        ['AB', 'ABK'], // ABKHAZIAN
        ['', 'ACE'], // ACHINESE
        ['', 'ACH'], // ACOLI
        ['', 'ADA'], // ADANGME
        ['', 'ADY'], // ADYGHE; ADYGEI
        ['', 'AFA'], // AFRO-ASIATIC LANGUAGES
        ['', 'AFH'], // AFRIHILI
        ['AF', 'AFR'], // AFRIKAANS
        ['', 'AIN'], // AINU
        ['AK', 'AKA'], // AKAN
        ['', 'AKK'], // AKKADIAN
        ['SQ', 'ALB'], // ALBANIAN
        ['', 'ALE'], // ALEUT
        ['', 'ALG'], // ALGONQUIAN LANGUAGES
        ['', 'ALT'], // SOUTHERN ALTAI
        ['AM', 'AMH'], // AMHARIC
        ['', 'ANG'], // ENGLISH, OLD (CA.450-1100)
        ['', 'ANP'], // ANGIKA
        ['', 'APA'], // APACHE LANGUAGES
        ['AR', 'ARA'], // ARABIC
        ['', 'ARC'], // OFFICIAL ARAMAIC (700-300 BCE); IMPERIAL ARAMAIC (700-300 BCE)
        ['AN', 'ARG'], // ARAGONESE
        ['HY', 'ARM'], // ARMENIAN
        ['', 'ARN'], // MAPUDUNGUN; MAPUCHE
        ['', 'ARP'], // ARAPAHO
        ['', 'ART'], // ARTIFICIAL LANGUAGES
        ['', 'ARW'], // ARAWAK
        ['AS', 'ASM'], // ASSAMESE
        ['', 'AST'], // ASTURIAN; BABLE; LEONESE; ASTURLEONESE
        ['', 'ATH'], // ATHAPASCAN LANGUAGES
        ['', 'AUS'], // AUSTRALIAN LANGUAGES
        ['AV', 'AVA'], // AVARIC
        ['AE', 'AVE'], // AVESTAN
        ['', 'AWA'], // AWADHI
        ['AY', 'AYM'], // AYMARA
        ['AZ', 'AZE'], // AZERBAIJANI
        ['', 'BAD'], // BANDA LANGUAGES
        ['', 'BAI'], // BAMILEKE LANGUAGES
        ['BA', 'BAK'], // BASHKIR
        ['', 'BAL'], // BALUCHI
        ['BM', 'BAM'], // BAMBARA
        ['', 'BAN'], // BALINESE
        ['EU', 'BAQ'], // BASQUE
        ['', 'BAS'], // BASA
        ['', 'BAT'], // BALTIC LANGUAGES
        ['', 'BEJ'], // BEJA; BEDAWIYET
        ['BE', 'BEL'], // BELARUSIAN
        ['', 'BEM'], // BEMBA
        ['BN', 'BEN'], // BENGALI
        ['', 'BER'], // BERBER LANGUAGES
        ['', 'BHO'], // BHOJPURI
        ['BH', 'BIH'], // BIHARI LANGUAGES
        ['', 'BIK'], // BIKOL
        ['', 'BIN'], // BINI; EDO
        ['BI', 'BIS'], // BISLAMA
        ['', 'BLA'], // SIKSIKA
        ['', 'BNT'], // BANTU (OTHER)
        ['BS', 'BOS'], // BOSNIAN
        ['', 'BRA'], // BRAJ
        ['BR', 'BRE'], // BRETON
        ['', 'BTK'], // BATAK LANGUAGES
        ['', 'BUA'], // BURIAT
        ['', 'BUG'], // BUGINESE
        ['BG', 'BUL'], // BULGARIAN
        ['MY', 'BUR'], // BURMESE
        ['', 'BYN'], // BLIN; BILIN
        ['', 'CAD'], // CADDO
        ['', 'CAI'], // CENTRAL AMERICAN INDIAN LANGUAGES
        ['', 'CAR'], // GALIBI CARIB
        ['CA', 'CAT'], // CATALAN; VALENCIAN
        ['', 'CAU'], // CAUCASIAN LANGUAGES
        ['', 'CEB'], // CEBUANO
        ['', 'CEL'], // CELTIC LANGUAGES
        ['CH', 'CHA'], // CHAMORRO
        ['', 'CHB'], // CHIBCHA
        ['CE', 'CHE'], // CHECHEN
        ['', 'CHG'], // CHAGATAI
        ['ZH', 'CHI'], // CHINESE
        ['', 'CHK'], // CHUUKESE
        ['', 'CHM'], // MARI
        ['', 'CHN'], // CHINOOK JARGON
        ['', 'CHO'], // CHOCTAW
        ['', 'CHP'], // CHIPEWYAN; DENE SULINE
        ['', 'CHR'], // CHEROKEE
        ['CU', 'CHU'], // CHURCH SLAVIC; OLD SLAVONIC; CHURCH SLAVONIC; OLD BULGARIAN; OLD CHURCH SLAVONIC
        ['CV', 'CHV'], // CHUVASH
        ['', 'CHY'], // CHEYENNE
        ['', 'CMC'], // CHAMIC LANGUAGES
        ['', 'COP'], // COPTIC
        ['KW', 'COR'], // CORNISH
        ['CO', 'COS'], // CORSICAN
        ['', 'CPE'], // CREOLES AND PIDGINS, ENGLISH BASED
        ['', 'CPF'], // CREOLES AND PIDGINS, FRENCH-BASED
        ['', 'CPP'], // CREOLES AND PIDGINS, PORTUGUESE-BASED
        ['CR', 'CRE'], // CREE
        ['', 'CRH'], // CRIMEAN TATAR; CRIMEAN TURKISH
        ['', 'CRP'], // CREOLES AND PIDGINS
        ['', 'CSB'], // KASHUBIAN
        ['', 'CUS'], // CUSHITIC LANGUAGES
        ['CS', 'CZE'], // CZECH
        ['', 'DAK'], // DAKOTA
        ['DA', 'DAN'], // DANISH
        ['', 'DAR'], // DARGWA
        ['', 'DAY'], // LAND DAYAK LANGUAGES
        ['', 'DEL'], // DELAWARE
        ['', 'DEN'], // SLAVE (ATHAPASCAN)
        ['', 'DGR'], // DOGRIB
        ['', 'DIN'], // DINKA
        ['DV', 'DIV'], // DIVEHI; DHIVEHI; MALDIVIAN
        ['', 'DOI'], // DOGRI
        ['', 'DRA'], // DRAVIDIAN LANGUAGES
        ['', 'DSB'], // LOWER SORBIAN
        ['', 'DUA'], // DUALA
        ['', 'DUM'], // DUTCH, MIDDLE (CA.1050-1350)
        ['NL', 'DUT'], // DUTCH; FLEMISH
        ['', 'DYU'], // DYULA
        ['DZ', 'DZO'], // DZONGKHA
        ['', 'EFI'], // EFIK
        ['', 'EGY'], // EGYPTIAN (ANCIENT)
        ['', 'EKA'], // EKAJUK
        ['', 'ELX'], // ELAMITE
        ['EN', 'ENG'], // ENGLISH
        ['', 'ENM'], // ENGLISH, MIDDLE (1100-1500)
        ['EO', 'EPO'], // ESPERANTO
        ['ET', 'EST'], // ESTONIAN
        ['EE', 'EWE'], // EWE
        ['', 'EWO'], // EWONDO
        ['', 'FAN'], // FANG
        ['FO', 'FAO'], // FAROESE
        ['', 'FAT'], // FANTI
        ['FJ', 'FIJ'], // FIJIAN
        ['', 'FIL'], // FILIPINO; PILIPINO
        ['FI', 'FIN'], // FINNISH
        ['', 'FIU'], // FINNO-UGRIAN LANGUAGES
        ['', 'FON'], // FON
        ['FR', 'FRE'], // FRENCH
        ['', 'FRM'], // FRENCH, MIDDLE (CA.1400-1600)
        ['', 'FRO'], // FRENCH, OLD (842-CA.1400)
        ['', 'FRR'], // NORTHERN FRISIAN
        ['', 'FRS'], // EASTERN FRISIAN
        ['FY', 'FRY'], // WESTERN FRISIAN
        ['FF', 'FUL'], // FULAH
        ['', 'FUR'], // FRIULIAN
        ['', 'GAA'], // GA
        ['', 'GAY'], // GAYO
        ['', 'GBA'], // GBAYA
        ['', 'GEM'], // GERMANIC LANGUAGES
        ['KA', 'GEO'], // GEORGIAN
        ['DE', 'GER'], // GERMAN
        ['', 'GEZ'], // GEEZ
        ['', 'GIL'], // GILBERTESE
        ['GD', 'GLA'], // GAELIC; SCOTTISH GAELIC
        ['GA', 'GLE'], // IRISH
        ['GL', 'GLG'], // GALICIAN
        ['GV', 'GLV'], // MANX
        ['', 'GMH'], // GERMAN, MIDDLE HIGH (CA.1050-1500)
        ['', 'GOH'], // GERMAN, OLD HIGH (CA.750-1050)
        ['', 'GON'], // GONDI
        ['', 'GOR'], // GORONTALO
        ['', 'GOT'], // GOTHIC
        ['', 'GRB'], // GREBO
        ['', 'GRC'], // GREEK, ANCIENT (TO 1453)
        ['EL', 'GRE'], // GREEK, MODERN (1453-)
        ['GN', 'GRN'], // GUARANI
        ['', 'GSW'], // SWISS GERMAN; ALEMANNIC; ALSATIAN
        ['GU', 'GUJ'], // GUJARATI
        ['', 'GWI'], // GWICH'IN
        ['', 'HAI'], // HAIDA
        ['HT', 'HAT'], // HAITIAN; HAITIAN CREOLE
        ['HA', 'HAU'], // HAUSA
        ['', 'HAW'], // HAWAIIAN
        ['HE', 'HEB'], // HEBREW
        ['HZ', 'HER'], // HERERO
        ['', 'HIL'], // HILIGAYNON
        ['', 'HIM'], // HIMACHALI LANGUAGES; WESTERN PAHARI LANGUAGES
        ['HI', 'HIN'], // HINDI
        ['', 'HIT'], // HITTITE
        ['', 'HMN'], // HMONG; MONG
        ['HO', 'HMO'], // HIRI MOTU
        ['HR', 'HRV'], // CROATIAN
        ['', 'HSB'], // UPPER SORBIAN
        ['HU', 'HUN'], // HUNGARIAN
        ['', 'HUP'], // HUPA
        ['', 'IBA'], // IBAN
        ['IG', 'IBO'], // IGBO
        ['IS', 'ICE'], // ICELANDIC
        ['IO', 'IDO'], // IDO
        ['II', 'III'], // SICHUAN YI; NUOSU
        ['', 'IJO'], // IJO LANGUAGES
        ['IU', 'IKU'], // INUKTITUT
        ['IE', 'ILE'], // INTERLINGUE; OCCIDENTAL
        ['', 'ILO'], // ILOKO
        ['IA', 'INA'], // INTERLINGUA (INTERNATIONAL AUXILIARY LANGUAGE ASSOCIATION)
        ['', 'INC'], // INDIC LANGUAGES
        ['ID', 'IND'], // INDONESIAN
        ['', 'INE'], // INDO-EUROPEAN LANGUAGES
        ['', 'INH'], // INGUSH
        ['IK', 'IPK'], // INUPIAQ
        ['', 'IRA'], // IRANIAN LANGUAGES
        ['', 'IRO'], // IROQUOIAN LANGUAGES
        ['IT', 'ITA'], // ITALIAN
        ['JV', 'JAV'], // JAVANESE
        ['', 'JBO'], // LOJBAN
        ['JA', 'JPN'], // JAPANESE
        ['', 'JPR'], // JUDEO-PERSIAN
        ['', 'JRB'], // JUDEO-ARABIC
        ['', 'KAA'], // KARA-KALPAK
        ['', 'KAB'], // KABYLE
        ['', 'KAC'], // KACHIN; JINGPHO
        ['KL', 'KAL'], // KALAALLISUT; GREENLANDIC
        ['', 'KAM'], // KAMBA
        ['KN', 'KAN'], // KANNADA
        ['', 'KAR'], // KAREN LANGUAGES
        ['KS', 'KAS'], // KASHMIRI
        ['KR', 'KAU'], // KANURI
        ['', 'KAW'], // KAWI
        ['KK', 'KAZ'], // KAZAKH
        ['', 'KBD'], // KABARDIAN
        ['', 'KHA'], // KHASI
        ['', 'KHI'], // KHOISAN LANGUAGES
        ['KM', 'KHM'], // CENTRAL KHMER
        ['', 'KHO'], // KHOTANESE; SAKAN
        ['KI', 'KIK'], // KIKUYU; GIKUYU
        ['RW', 'KIN'], // KINYARWANDA
        ['KY', 'KIR'], // KIRGHIZ; KYRGYZ
        ['', 'KMB'], // KIMBUNDU
        ['', 'KOK'], // KONKANI
        ['KV', 'KOM'], // KOMI
        ['KG', 'KON'], // KONGO
        ['KO', 'KOR'], // KOREAN
        ['', 'KOS'], // KOSRAEAN
        ['', 'KPE'], // KPELLE
        ['', 'KRC'], // KARACHAY-BALKAR
        ['', 'KRL'], // KARELIAN
        ['', 'KRO'], // KRU LANGUAGES
        ['', 'KRU'], // KURUKH
        ['KJ', 'KUA'], // KUANYAMA; KWANYAMA
        ['', 'KUM'], // KUMYK
        ['KU', 'KUR'], // KURDISH
        ['', 'KUT'], // KUTENAI
        ['', 'LAD'], // LADINO
        ['', 'LAH'], // LAHNDA
        ['', 'LAM'], // LAMBA
        ['LO', 'LAO'], // LAO
        ['LA', 'LAT'], // LATIN
        ['LV', 'LAV'], // LATVIAN
        ['', 'LEZ'], // LEZGHIAN
        ['LI', 'LIM'], // LIMBURGAN; LIMBURGER; LIMBURGISH
        ['LN', 'LIN'], // LINGALA
        ['LT', 'LIT'], // LITHUANIAN
        ['', 'LOL'], // MONGO
        ['', 'LOZ'], // LOZI
        ['LB', 'LTZ'], // LUXEMBOURGISH; LETZEBURGESCH
        ['', 'LUA'], // LUBA-LULUA
        ['LU', 'LUB'], // LUBA-KATANGA
        ['LG', 'LUG'], // GANDA
        ['', 'LUI'], // LUISENO
        ['', 'LUN'], // LUNDA
        ['', 'LUO'], // LUO (KENYA AND TANZANIA)
        ['', 'LUS'], // LUSHAI
        ['MK', 'MAC'], // MACEDONIAN
        ['', 'MAD'], // MADURESE
        ['', 'MAG'], // MAGAHI
        ['MH', 'MAH'], // MARSHALLESE
        ['', 'MAI'], // MAITHILI
        ['', 'MAK'], // MAKASAR
        ['ML', 'MAL'], // MALAYALAM
        ['', 'MAN'], // MANDINGO
        ['MI', 'MAO'], // MAORI
        ['', 'MAP'], // AUSTRONESIAN LANGUAGES
        ['MR', 'MAR'], // MARATHI
        ['', 'MAS'], // MASAI
        ['MS', 'MAY'], // MALAY
        ['', 'MDF'], // MOKSHA
        ['', 'MDR'], // MANDAR
        ['', 'MEN'], // MENDE
        ['', 'MGA'], // IRISH, MIDDLE (900-1200)
        ['', 'MIC'], // MI'KMAQ; MICMAC
        ['', 'MIN'], // MINANGKABAU
        ['', 'MIS'], // UNCODED LANGUAGES
        ['', 'MKH'], // MON-KHMER LANGUAGES
        ['MG', 'MLG'], // MALAGASY
        ['MT', 'MLT'], // MALTESE
        ['', 'MNC'], // MANCHU
        ['', 'MNI'], // MANIPURI
        ['', 'MNO'], // MANOBO LANGUAGES
        ['', 'MOH'], // MOHAWK
        ['MN', 'MON'], // MONGOLIAN
        ['', 'MOS'], // MOSSI
        ['', 'MUL'], // MULTIPLE LANGUAGES
        ['', 'MUN'], // MUNDA LANGUAGES
        ['', 'MUS'], // CREEK
        ['', 'MWL'], // MIRANDESE
        ['', 'MWR'], // MARWARI
        ['', 'MYN'], // MAYAN LANGUAGES
        ['', 'MYV'], // ERZYA
        ['', 'NAH'], // NAHUATL LANGUAGES
        ['', 'NAI'], // NORTH AMERICAN INDIAN LANGUAGES
        ['', 'NAP'], // NEAPOLITAN
        ['NA', 'NAU'], // NAURU
        ['NV', 'NAV'], // NAVAJO; NAVAHO
        ['NR', 'NBL'], // NDEBELE, SOUTH; SOUTH NDEBELE
        ['ND', 'NDE'], // NDEBELE, NORTH; NORTH NDEBELE
        ['NG', 'NDO'], // NDONGA
        ['', 'NDS'], // LOW GERMAN; LOW SAXON; GERMAN, LOW; SAXON, LOW
        ['NE', 'NEP'], // NEPALI
        ['', 'NEW'], // NEPAL BHASA; NEWARI
        ['', 'NIA'], // NIAS
        ['', 'NIC'], // NIGER-KORDOFANIAN LANGUAGES
        ['', 'NIU'], // NIUEAN
        ['NN', 'NNO'], // NORWEGIAN NYNORSK; NYNORSK, NORWEGIAN
        ['NB', 'NOB'], // BOKMÅL, NORWEGIAN; NORWEGIAN BOKMÅL
        ['', 'NOG'], // NOGAI
        ['', 'NON'], // NORSE, OLD
        ['NO', 'NOR'], // NORWEGIAN
        ['', 'NQO'], // N'KO
        ['', 'NSO'], // PEDI; SEPEDI; NORTHERN SOTHO
        ['', 'NUB'], // NUBIAN LANGUAGES
        ['', 'NWC'], // CLASSICAL NEWARI; OLD NEWARI; CLASSICAL NEPAL BHASA
        ['NY', 'NYA'], // CHICHEWA; CHEWA; NYANJA
        ['', 'NYM'], // NYAMWEZI
        ['', 'NYN'], // NYANKOLE
        ['', 'NYO'], // NYORO
        ['', 'NZI'], // NZIMA
        ['OC', 'OCI'], // OCCITAN (POST 1500); PROVENÇAL
        ['OJ', 'OJI'], // OJIBWA
        ['OR', 'ORI'], // ORIYA
        ['OM', 'ORM'], // OROMO
        ['', 'OSA'], // OSAGE
        ['OS', 'OSS'], // OSSETIAN; OSSETIC
        ['', 'OTA'], // TURKISH, OTTOMAN (1500-1928)
        ['', 'OTO'], // OTOMIAN LANGUAGES
        ['', 'PAA'], // PAPUAN LANGUAGES
        ['', 'PAG'], // PANGASINAN
        ['', 'PAL'], // PAHLAVI
        ['', 'PAM'], // PAMPANGA; KAPAMPANGAN
        ['PA', 'PAN'], // PANJABI; PUNJABI
        ['', 'PAP'], // PAPIAMENTO
        ['', 'PAU'], // PALAUAN
        ['', 'PEO'], // PERSIAN, OLD (CA.600-400 B.C.)
        ['FA', 'PER'], // PERSIAN
        ['', 'PHI'], // PHILIPPINE LANGUAGES
        ['', 'PHN'], // PHOENICIAN
        ['PI', 'PLI'], // PALI
        ['PL', 'POL'], // POLISH
        ['', 'PON'], // POHNPEIAN
        ['PT', 'POR'], // PORTUGUESE
        ['', 'PRA'], // PRAKRIT LANGUAGES
        ['', 'PRO'], // PROVENÇAL, OLD (TO 1500)
        ['PS', 'PUS'], // PUSHTO; PASHTO
        ['', 'QAA-QTZ'], // RESERVED FOR LOCAL USE
        ['QU', 'QUE'], // QUECHUA
        ['', 'RAJ'], // RAJASTHANI
        ['', 'RAP'], // RAPANUI
        ['', 'RAR'], // RAROTONGAN; COOK ISLANDS MAORI
        ['', 'ROA'], // ROMANCE LANGUAGES
        ['RM', 'ROH'], // ROMANSH
        ['', 'ROM'], // ROMANY
        ['RO', 'RUM'], // ROMANIAN; MOLDAVIAN; MOLDOVAN
        ['RN', 'RUN'], // RUNDI
        ['', 'RUP'], // AROMANIAN; ARUMANIAN; MACEDO-ROMANIAN
        ['RU', 'RUS'], // RUSSIAN
        ['', 'SAD'], // SANDAWE
        ['SG', 'SAG'], // SANGO
        ['', 'SAH'], // YAKUT
        ['', 'SAI'], // SOUTH AMERICAN INDIAN (OTHER)
        ['', 'SAL'], // SALISHAN LANGUAGES
        ['', 'SAM'], // SAMARITAN ARAMAIC
        ['SA', 'SAN'], // SANSKRIT
        ['', 'SAS'], // SASAK
        ['', 'SAT'], // SANTALI
        ['', 'SCN'], // SICILIAN
        ['', 'SCO'], // SCOTS
        ['', 'SEL'], // SELKUP
        ['', 'SEM'], // SEMITIC LANGUAGES
        ['', 'SGA'], // IRISH, OLD (TO 900)
        ['', 'SGN'], // SIGN LANGUAGES
        ['', 'SHN'], // SHAN
        ['', 'SID'], // SIDAMO
        ['SI', 'SIN'], // SINHALA; SINHALESE
        ['', 'SIO'], // SIOUAN LANGUAGES
        ['', 'SIT'], // SINO-TIBETAN LANGUAGES
        ['', 'SLA'], // SLAVIC LANGUAGES
        ['SK', 'SLO'], // SLOVAK
        ['SL', 'SLV'], // SLOVENIAN
        ['', 'SMA'], // SOUTHERN SAMI
        ['SE', 'SME'], // NORTHERN SAMI
        ['', 'SMI'], // SAMI LANGUAGES
        ['', 'SMJ'], // LULE SAMI
        ['', 'SMN'], // INARI SAMI
        ['SM', 'SMO'], // SAMOAN
        ['', 'SMS'], // SKOLT SAMI
        ['SN', 'SNA'], // SHONA
        ['SD', 'SND'], // SINDHI
        ['', 'SNK'], // SONINKE
        ['', 'SOG'], // SOGDIAN
        ['SO', 'SOM'], // SOMALI
        ['', 'SON'], // SONGHAI LANGUAGES
        ['ST', 'SOT'], // SOTHO, SOUTHERN
        ['ES', 'SPA'], // SPANISH; CASTILIAN
        ['SC', 'SRD'], // SARDINIAN
        ['', 'SRN'], // SRANAN TONGO
        ['SR', 'SRP'], // SERBIAN
        ['', 'SRR'], // SERER
        ['', 'SSA'], // NILO-SAHARAN LANGUAGES
        ['SS', 'SSW'], // SWATI
        ['', 'SUK'], // SUKUMA
        ['SU', 'SUN'], // SUNDANESE
        ['', 'SUS'], // SUSU
        ['', 'SUX'], // SUMERIAN
        ['SW', 'SWA'], // SWAHILI
        ['SV', 'SWE'], // SWEDISH
        ['', 'SYC'], // CLASSICAL SYRIAC
        ['', 'SYR'], // SYRIAC
        ['TY', 'TAH'], // TAHITIAN
        ['', 'TAI'], // TAI LANGUAGES
        ['TA', 'TAM'], // TAMIL
        ['TT', 'TAT'], // TATAR
        ['TE', 'TEL'], // TELUGU
        ['', 'TEM'], // TIMNE
        ['', 'TER'], // TERENO
        ['', 'TET'], // TETUM
        ['TG', 'TGK'], // TAJIK
        ['TL', 'TGL'], // TAGALOG
        ['TH', 'THA'], // THAI
        ['BO', 'TIB'], // TIBETAN
        ['', 'TIG'], // TIGRE
        ['TI', 'TIR'], // TIGRINYA
        ['', 'TIV'], // TIV
        ['', 'TKL'], // TOKELAU
        ['', 'TLH'], // KLINGON; TLHINGAN-HOL
        ['', 'TLI'], // TLINGIT
        ['', 'TMH'], // TAMASHEK
        ['', 'TOG'], // TONGA (NYASA)
        ['TO', 'TON'], // TONGA (TONGA ISLANDS)
        ['', 'TPI'], // TOK PISIN
        ['', 'TSI'], // TSIMSHIAN
        ['TN', 'TSN'], // TSWANA
        ['TS', 'TSO'], // TSONGA
        ['TK', 'TUK'], // TURKMEN
        ['', 'TUM'], // TUMBUKA
        ['', 'TUP'], // TUPI LANGUAGES
        ['TR', 'TUR'], // TURKISH
        ['', 'TUT'], // ALTAIC LANGUAGES
        ['', 'TVL'], // TUVALU
        ['TW', 'TWI'], // TWI
        ['', 'TYV'], // TUVINIAN
        ['', 'UDM'], // UDMURT
        ['', 'UGA'], // UGARITIC
        ['UG', 'UIG'], // UIGHUR; UYGHUR
        ['UK', 'UKR'], // UKRAINIAN
        ['', 'UMB'], // UMBUNDU
        ['', 'UND'], // UNDETERMINED
        ['UR', 'URD'], // URDU
        ['UZ', 'UZB'], // UZBEK
        ['', 'VAI'], // VAI
        ['VE', 'VEN'], // VENDA
        ['VI', 'VIE'], // VIETNAMESE
        ['VO', 'VOL'], // VOLAPÜK
        ['', 'VOT'], // VOTIC
        ['', 'WAK'], // WAKASHAN LANGUAGES
        ['', 'WAL'], // WALAMO
        ['', 'WAR'], // WARAY
        ['', 'WAS'], // WASHO
        ['CY', 'WEL'], // WELSH
        ['', 'WEN'], // SORBIAN LANGUAGES
        ['WA', 'WLN'], // WALLOON
        ['WO', 'WOL'], // WOLOF
        ['', 'XAL'], // KALMYK; OIRAT
        ['XH', 'XHO'], // XHOSA
        ['', 'YAO'], // YAO
        ['', 'YAP'], // YAPESE
        ['YI', 'YID'], // YIDDISH
        ['YO', 'YOR'], // YORUBA
        ['', 'YPK'], // YUPIK LANGUAGES
        ['', 'ZAP'], // ZAPOTEC
        ['', 'ZBL'], // BLISSYMBOLS; BLISSYMBOLICS; BLISS
        ['', 'ZEN'], // ZENAGA
        ['', 'ZGH'], // STANDARD MOROCCAN TAMAZIGHT
        ['ZA', 'ZHA'], // ZHUANG; CHUANG
        ['', 'ZND'], // ZANDE LANGUAGES
        ['ZU', 'ZUL'], // ZULU
        ['', 'ZUN'], // ZUNI
        ['', 'ZXX'], // NO LINGUISTIC CONTENT; NOT APPLICABLE
        ['', 'ZZA'], // ZAZA; DIMILI; DIMLI; KIRDKI; KIRMANJKI; ZAZAKI
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
