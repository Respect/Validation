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

use Respect\Validation\Exceptions\ComponentException;
use function array_column;
use function array_filter;
use function array_search;

/**
 * Validates whether the input is language code based on ISO 639.
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LanguageCode extends AbstractEnvelope
{
    public const ALPHA2 = 'alpha-2';
    public const ALPHA3 = 'alpha-3';
    public const AVAILABLE_SETS = [
        self::ALPHA2,
        self::ALPHA3,
    ];

    /**
     * @see http://www.loc.gov/standards/iso639-2/ISO-639-2_utf-8.txt
     *
     */
    public const LANGUAGE_CODES = [
        ['aa', '﻿aar'], // Afar
        ['ab', 'abk'], // Abkhazian
        ['', 'ace'], // Achinese
        ['', 'ach'], // Acoli
        ['', 'ada'], // Adangme
        ['', 'ady'], // Adyghe; Adygei
        ['', 'afa'], // Afro-asiatic languages
        ['', 'afh'], // Afrihili
        ['af', 'afr'], // Afrikaans
        ['', 'ain'], // Ainu
        ['ak', 'aka'], // Akan
        ['', 'akk'], // Akkadian
        ['sq', 'alb'], // Albanian
        ['', 'ale'], // Aleut
        ['', 'alg'], // Algonquian languages
        ['', 'alt'], // Southern altai
        ['am', 'amh'], // Amharic
        ['', 'ang'], // English, old - ca.450-1100
        ['', 'anp'], // Angika
        ['', 'apa'], // Apache languages
        ['ar', 'ara'], // Arabic
        ['', 'arc'], // Official aramaic - 700-300 bce; Imperial aramaic - 700-300 bce
        ['an', 'arg'], // Aragonese
        ['hy', 'arm'], // Armenian
        ['', 'arn'], // Mapudungun; Mapuche
        ['', 'arp'], // Arapaho
        ['', 'art'], // Artificial languages
        ['', 'arw'], // Arawak
        ['as', 'asm'], // Assamese
        ['', 'ast'], // Asturian; Bable; Leonese; Asturleonese
        ['', 'ath'], // Athapascan languages
        ['', 'aus'], // Australian languages
        ['av', 'ava'], // Avaric
        ['ae', 'ave'], // Avestan
        ['', 'awa'], // Awadhi
        ['ay', 'aym'], // Aymara
        ['az', 'aze'], // Azerbaijani
        ['', 'bad'], // Banda languages
        ['', 'bai'], // Bamileke languages
        ['ba', 'bak'], // Bashkir
        ['', 'bal'], // Baluchi
        ['bm', 'bam'], // Bambara
        ['', 'ban'], // Balinese
        ['eu', 'baq'], // Basque
        ['', 'bas'], // Basa
        ['', 'bat'], // Baltic languages
        ['', 'bej'], // Beja; Bedawiyet
        ['be', 'bel'], // Belarusian
        ['', 'bem'], // Bemba
        ['bn', 'ben'], // Bengali
        ['', 'ber'], // Berber languages
        ['', 'bho'], // Bhojpuri
        ['bh', 'bih'], // Bihari languages
        ['', 'bik'], // Bikol
        ['', 'bin'], // Bini; Edo
        ['bi', 'bis'], // Bislama
        ['', 'bla'], // Siksika
        ['', 'bnt'], // Bantu - other
        ['bs', 'bos'], // Bosnian
        ['', 'bra'], // Braj
        ['br', 'bre'], // Breton
        ['', 'btk'], // Batak languages
        ['', 'bua'], // Buriat
        ['', 'bug'], // Buginese
        ['bg', 'bul'], // Bulgarian
        ['my', 'bur'], // Burmese
        ['', 'byn'], // Blin; Bilin
        ['', 'cad'], // Caddo
        ['', 'cai'], // Central american indian languages
        ['', 'car'], // Galibi carib
        ['ca', 'cat'], // Catalan; Valencian
        ['', 'cau'], // Caucasian languages
        ['', 'ceb'], // Cebuano
        ['', 'cel'], // Celtic languages
        ['ch', 'cha'], // Chamorro
        ['', 'chb'], // Chibcha
        ['ce', 'che'], // Chechen
        ['', 'chg'], // Chagatai
        ['zh', 'chi'], // Chinese
        ['', 'chk'], // Chuukese
        ['', 'chm'], // Mari
        ['', 'chn'], // Chinook jargon
        ['', 'cho'], // Choctaw
        ['', 'chp'], // Chipewyan; Dene suline
        ['', 'chr'], // Cherokee
        ['cu', 'chu'], // Church slavic; Old slavonic; Church slavonic; Old bulgarian; Old church slavonic
        ['cv', 'chv'], // Chuvash
        ['', 'chy'], // Cheyenne
        ['', 'cmc'], // Chamic languages
        ['', 'cop'], // Coptic
        ['kw', 'cor'], // Cornish
        ['co', 'cos'], // Corsican
        ['', 'cpe'], // Creoles and pidgins, english based
        ['', 'cpf'], // Creoles and pidgins, french-based
        ['', 'cpp'], // Creoles and pidgins, portuguese-based
        ['cr', 'cre'], // Cree
        ['', 'crh'], // Crimean tatar; Crimean turkish
        ['', 'crp'], // Creoles and pidgins
        ['', 'csb'], // Kashubian
        ['', 'cus'], // Cushitic languages
        ['cs', 'cze'], // Czech
        ['', 'dak'], // Dakota
        ['da', 'dan'], // Danish
        ['', 'dar'], // Dargwa
        ['', 'day'], // Land dayak languages
        ['', 'del'], // Delaware
        ['', 'den'], // Slave - athapascan
        ['', 'dgr'], // Dogrib
        ['', 'din'], // Dinka
        ['dv', 'div'], // Divehi; Dhivehi; Maldivian
        ['', 'doi'], // Dogri
        ['', 'dra'], // Dravidian languages
        ['', 'dsb'], // Lower sorbian
        ['', 'dua'], // Duala
        ['', 'dum'], // Dutch, middle - ca.1050-1350
        ['nl', 'dut'], // Dutch; Flemish
        ['', 'dyu'], // Dyula
        ['dz', 'dzo'], // Dzongkha
        ['', 'efi'], // Efik
        ['', 'egy'], // Egyptian - ancient
        ['', 'eka'], // Ekajuk
        ['', 'elx'], // Elamite
        ['en', 'eng'], // English
        ['', 'enm'], // English, middle - 1100-1500
        ['eo', 'epo'], // Esperanto
        ['et', 'est'], // Estonian
        ['ee', 'ewe'], // Ewe
        ['', 'ewo'], // Ewondo
        ['', 'fan'], // Fang
        ['fo', 'fao'], // Faroese
        ['', 'fat'], // Fanti
        ['fj', 'fij'], // Fijian
        ['', 'fil'], // Filipino; Pilipino
        ['fi', 'fin'], // Finnish
        ['', 'fiu'], // Finno-ugrian languages
        ['', 'fon'], // Fon
        ['fr', 'fre'], // French
        ['', 'frm'], // French, middle - ca.1400-1600
        ['', 'fro'], // French, old - 842-ca.1400
        ['', 'frr'], // Northern frisian
        ['', 'frs'], // Eastern frisian
        ['fy', 'fry'], // Western frisian
        ['ff', 'ful'], // Fulah
        ['', 'fur'], // Friulian
        ['', 'gaa'], // Ga
        ['', 'gay'], // Gayo
        ['', 'gba'], // Gbaya
        ['', 'gem'], // Germanic languages
        ['ka', 'geo'], // Georgian
        ['de', 'ger'], // German
        ['', 'gez'], // Geez
        ['', 'gil'], // Gilbertese
        ['gd', 'gla'], // Gaelic; Scottish gaelic
        ['ga', 'gle'], // Irish
        ['gl', 'glg'], // Galician
        ['gv', 'glv'], // Manx
        ['', 'gmh'], // German, middle high - ca.1050-1500
        ['', 'goh'], // German, old high - ca.750-1050
        ['', 'gon'], // Gondi
        ['', 'gor'], // Gorontalo
        ['', 'got'], // Gothic
        ['', 'grb'], // Grebo
        ['', 'grc'], // Greek, ancient - to 1453
        ['el', 'gre'], // Greek, modern - 1453-
        ['gn', 'grn'], // Guarani
        ['', 'gsw'], // Swiss german; Alemannic; Alsatian
        ['gu', 'guj'], // Gujarati
        ['', 'gwi'], // Gwich'in
        ['', 'hai'], // Haida
        ['ht', 'hat'], // Haitian; Haitian creole
        ['ha', 'hau'], // Hausa
        ['', 'haw'], // Hawaiian
        ['he', 'heb'], // Hebrew
        ['hz', 'her'], // Herero
        ['', 'hil'], // Hiligaynon
        ['', 'him'], // Himachali languages; Western pahari languages
        ['hi', 'hin'], // Hindi
        ['', 'hit'], // Hittite
        ['', 'hmn'], // Hmong; Mong
        ['ho', 'hmo'], // Hiri motu
        ['hr', 'hrv'], // Croatian
        ['', 'hsb'], // Upper sorbian
        ['hu', 'hun'], // Hungarian
        ['', 'hup'], // Hupa
        ['', 'iba'], // Iban
        ['ig', 'ibo'], // Igbo
        ['is', 'ice'], // Icelandic
        ['io', 'ido'], // Ido
        ['ii', 'iii'], // Sichuan yi; Nuosu
        ['', 'ijo'], // Ijo languages
        ['iu', 'iku'], // Inuktitut
        ['ie', 'ile'], // Interlingue; Occidental
        ['', 'ilo'], // Iloko
        ['ia', 'ina'], // Interlingua - international auxiliary language association
        ['', 'inc'], // Indic languages
        ['id', 'ind'], // Indonesian
        ['', 'ine'], // Indo-european languages
        ['', 'inh'], // Ingush
        ['ik', 'ipk'], // Inupiaq
        ['', 'ira'], // Iranian languages
        ['', 'iro'], // Iroquoian languages
        ['it', 'ita'], // Italian
        ['jv', 'jav'], // Javanese
        ['', 'jbo'], // Lojban
        ['ja', 'jpn'], // Japanese
        ['', 'jpr'], // Judeo-persian
        ['', 'jrb'], // Judeo-arabic
        ['', 'kaa'], // Kara-kalpak
        ['', 'kab'], // Kabyle
        ['', 'kac'], // Kachin; Jingpho
        ['kl', 'kal'], // Kalaallisut; Greenlandic
        ['', 'kam'], // Kamba
        ['kn', 'kan'], // Kannada
        ['', 'kar'], // Karen languages
        ['ks', 'kas'], // Kashmiri
        ['kr', 'kau'], // Kanuri
        ['', 'kaw'], // Kawi
        ['kk', 'kaz'], // Kazakh
        ['', 'kbd'], // Kabardian
        ['', 'kha'], // Khasi
        ['', 'khi'], // Khoisan languages
        ['km', 'khm'], // Central khmer
        ['', 'kho'], // Khotanese; Sakan
        ['ki', 'kik'], // Kikuyu; Gikuyu
        ['rw', 'kin'], // Kinyarwanda
        ['ky', 'kir'], // Kirghiz; Kyrgyz
        ['', 'kmb'], // Kimbundu
        ['', 'kok'], // Konkani
        ['kv', 'kom'], // Komi
        ['kg', 'kon'], // Kongo
        ['ko', 'kor'], // Korean
        ['', 'kos'], // Kosraean
        ['', 'kpe'], // Kpelle
        ['', 'krc'], // Karachay-balkar
        ['', 'krl'], // Karelian
        ['', 'kro'], // Kru languages
        ['', 'kru'], // Kurukh
        ['kj', 'kua'], // Kuanyama; Kwanyama
        ['', 'kum'], // Kumyk
        ['ku', 'kur'], // Kurdish
        ['', 'kut'], // Kutenai
        ['', 'lad'], // Ladino
        ['', 'lah'], // Lahnda
        ['', 'lam'], // Lamba
        ['lo', 'lao'], // Lao
        ['la', 'lat'], // Latin
        ['lv', 'lav'], // Latvian
        ['', 'lez'], // Lezghian
        ['li', 'lim'], // Limburgan; Limburger; Limburgish
        ['ln', 'lin'], // Lingala
        ['lt', 'lit'], // Lithuanian
        ['', 'lol'], // Mongo
        ['', 'loz'], // Lozi
        ['lb', 'ltz'], // Luxembourgish; Letzeburgesch
        ['', 'lua'], // Luba-lulua
        ['lu', 'lub'], // Luba-katanga
        ['lg', 'lug'], // Ganda
        ['', 'lui'], // Luiseno
        ['', 'lun'], // Lunda
        ['', 'luo'], // Luo - kenya and tanzania
        ['', 'lus'], // Lushai
        ['mk', 'mac'], // Macedonian
        ['', 'mad'], // Madurese
        ['', 'mag'], // Magahi
        ['mh', 'mah'], // Marshallese
        ['', 'mai'], // Maithili
        ['', 'mak'], // Makasar
        ['ml', 'mal'], // Malayalam
        ['', 'man'], // Mandingo
        ['mi', 'mao'], // Maori
        ['', 'map'], // Austronesian languages
        ['mr', 'mar'], // Marathi
        ['', 'mas'], // Masai
        ['ms', 'may'], // Malay
        ['', 'mdf'], // Moksha
        ['', 'mdr'], // Mandar
        ['', 'men'], // Mende
        ['', 'mga'], // Irish, middle - 900-1200
        ['', 'mic'], // Mi'kmaq; Micmac
        ['', 'min'], // Minangkabau
        ['', 'mis'], // Uncoded languages
        ['', 'mkh'], // Mon-khmer languages
        ['mg', 'mlg'], // Malagasy
        ['mt', 'mlt'], // Maltese
        ['', 'mnc'], // Manchu
        ['', 'mni'], // Manipuri
        ['', 'mno'], // Manobo languages
        ['', 'moh'], // Mohawk
        ['mn', 'mon'], // Mongolian
        ['', 'mos'], // Mossi
        ['', 'mul'], // Multiple languages
        ['', 'mun'], // Munda languages
        ['', 'mus'], // Creek
        ['', 'mwl'], // Mirandese
        ['', 'mwr'], // Marwari
        ['', 'myn'], // Mayan languages
        ['', 'myv'], // Erzya
        ['', 'nah'], // Nahuatl languages
        ['', 'nai'], // North american indian languages
        ['', 'nap'], // Neapolitan
        ['na', 'nau'], // Nauru
        ['nv', 'nav'], // Navajo; Navaho
        ['nr', 'nbl'], // Ndebele, south; South ndebele
        ['nd', 'nde'], // Ndebele, north; North ndebele
        ['ng', 'ndo'], // Ndonga
        ['', 'nds'], // Low german; Low saxon; German, low; Saxon, low
        ['ne', 'nep'], // Nepali
        ['', 'new'], // Nepal bhasa; Newari
        ['', 'nia'], // Nias
        ['', 'nic'], // Niger-kordofanian languages
        ['', 'niu'], // Niuean
        ['nn', 'nno'], // Norwegian nynorsk; Nynorsk, norwegian
        ['nb', 'nob'], // Bokmål, norwegian; Norwegian bokmål
        ['', 'nog'], // Nogai
        ['', 'non'], // Norse, old
        ['no', 'nor'], // Norwegian
        ['', 'nqo'], // N'ko
        ['', 'nso'], // Pedi; Sepedi; Northern sotho
        ['', 'nub'], // Nubian languages
        ['', 'nwc'], // Classical newari; Old newari; Classical nepal bhasa
        ['ny', 'nya'], // Chichewa; Chewa; Nyanja
        ['', 'nym'], // Nyamwezi
        ['', 'nyn'], // Nyankole
        ['', 'nyo'], // Nyoro
        ['', 'nzi'], // Nzima
        ['oc', 'oci'], // Occitan - post 1500; Provençal
        ['oj', 'oji'], // Ojibwa
        ['or', 'ori'], // Oriya
        ['om', 'orm'], // Oromo
        ['', 'osa'], // Osage
        ['os', 'oss'], // Ossetian; Ossetic
        ['', 'ota'], // Turkish, ottoman - 1500-1928
        ['', 'oto'], // Otomian languages
        ['', 'paa'], // Papuan languages
        ['', 'pag'], // Pangasinan
        ['', 'pal'], // Pahlavi
        ['', 'pam'], // Pampanga; Kapampangan
        ['pa', 'pan'], // Panjabi; Punjabi
        ['', 'pap'], // Papiamento
        ['', 'pau'], // Palauan
        ['', 'peo'], // Persian, old - ca.600-400 b.c.
        ['fa', 'per'], // Persian
        ['', 'phi'], // Philippine languages
        ['', 'phn'], // Phoenician
        ['pi', 'pli'], // Pali
        ['pl', 'pol'], // Polish
        ['', 'pon'], // Pohnpeian
        ['pt', 'por'], // Portuguese
        ['', 'pra'], // Prakrit languages
        ['', 'pro'], // Provençal, old - to 1500
        ['ps', 'pus'], // Pushto; Pashto
        ['', 'qaa-qtz'], // Reserved for local use
        ['qu', 'que'], // Quechua
        ['', 'raj'], // Rajasthani
        ['', 'rap'], // Rapanui
        ['', 'rar'], // Rarotongan; Cook islands maori
        ['', 'roa'], // Romance languages
        ['rm', 'roh'], // Romansh
        ['', 'rom'], // Romany
        ['ro', 'rum'], // Romanian; Moldavian; Moldovan
        ['rn', 'run'], // Rundi
        ['', 'rup'], // Aromanian; Arumanian; Macedo-romanian
        ['ru', 'rus'], // Russian
        ['', 'sad'], // Sandawe
        ['sg', 'sag'], // Sango
        ['', 'sah'], // Yakut
        ['', 'sai'], // South american indian - other
        ['', 'sal'], // Salishan languages
        ['', 'sam'], // Samaritan aramaic
        ['sa', 'san'], // Sanskrit
        ['', 'sas'], // Sasak
        ['', 'sat'], // Santali
        ['', 'scn'], // Sicilian
        ['', 'sco'], // Scots
        ['', 'sel'], // Selkup
        ['', 'sem'], // Semitic languages
        ['', 'sga'], // Irish, old - to 900
        ['', 'sgn'], // Sign languages
        ['', 'shn'], // Shan
        ['', 'sid'], // Sidamo
        ['si', 'sin'], // Sinhala; Sinhalese
        ['', 'sio'], // Siouan languages
        ['', 'sit'], // Sino-tibetan languages
        ['', 'sla'], // Slavic languages
        ['sk', 'slo'], // Slovak
        ['sl', 'slv'], // Slovenian
        ['', 'sma'], // Southern sami
        ['se', 'sme'], // Northern sami
        ['', 'smi'], // Sami languages
        ['', 'smj'], // Lule sami
        ['', 'smn'], // Inari sami
        ['sm', 'smo'], // Samoan
        ['', 'sms'], // Skolt sami
        ['sn', 'sna'], // Shona
        ['sd', 'snd'], // Sindhi
        ['', 'snk'], // Soninke
        ['', 'sog'], // Sogdian
        ['so', 'som'], // Somali
        ['', 'son'], // Songhai languages
        ['st', 'sot'], // Sotho, southern
        ['es', 'spa'], // Spanish; Castilian
        ['sc', 'srd'], // Sardinian
        ['', 'srn'], // Sranan tongo
        ['sr', 'srp'], // Serbian
        ['', 'srr'], // Serer
        ['', 'ssa'], // Nilo-saharan languages
        ['ss', 'ssw'], // Swati
        ['', 'suk'], // Sukuma
        ['su', 'sun'], // Sundanese
        ['', 'sus'], // Susu
        ['', 'sux'], // Sumerian
        ['sw', 'swa'], // Swahili
        ['sv', 'swe'], // Swedish
        ['', 'syc'], // Classical syriac
        ['', 'syr'], // Syriac
        ['ty', 'tah'], // Tahitian
        ['', 'tai'], // Tai languages
        ['ta', 'tam'], // Tamil
        ['tt', 'tat'], // Tatar
        ['te', 'tel'], // Telugu
        ['', 'tem'], // Timne
        ['', 'ter'], // Tereno
        ['', 'tet'], // Tetum
        ['tg', 'tgk'], // Tajik
        ['tl', 'tgl'], // Tagalog
        ['th', 'tha'], // Thai
        ['bo', 'tib'], // Tibetan
        ['', 'tig'], // Tigre
        ['ti', 'tir'], // Tigrinya
        ['', 'tiv'], // Tiv
        ['', 'tkl'], // Tokelau
        ['', 'tlh'], // Klingon; Tlhingan-hol
        ['', 'tli'], // Tlingit
        ['', 'tmh'], // Tamashek
        ['', 'tog'], // Tonga - nyasa
        ['to', 'ton'], // Tonga - tonga islands
        ['', 'tpi'], // Tok pisin
        ['', 'tsi'], // Tsimshian
        ['tn', 'tsn'], // Tswana
        ['ts', 'tso'], // Tsonga
        ['tk', 'tuk'], // Turkmen
        ['', 'tum'], // Tumbuka
        ['', 'tup'], // Tupi languages
        ['tr', 'tur'], // Turkish
        ['', 'tut'], // Altaic languages
        ['', 'tvl'], // Tuvalu
        ['tw', 'twi'], // Twi
        ['', 'tyv'], // Tuvinian
        ['', 'udm'], // Udmurt
        ['', 'uga'], // Ugaritic
        ['ug', 'uig'], // Uighur; Uyghur
        ['uk', 'ukr'], // Ukrainian
        ['', 'umb'], // Umbundu
        ['', 'und'], // Undetermined
        ['ur', 'urd'], // Urdu
        ['uz', 'uzb'], // Uzbek
        ['', 'vai'], // Vai
        ['ve', 'ven'], // Venda
        ['vi', 'vie'], // Vietnamese
        ['vo', 'vol'], // Volapük
        ['', 'vot'], // Votic
        ['', 'wak'], // Wakashan languages
        ['', 'wal'], // Walamo
        ['', 'war'], // Waray
        ['', 'was'], // Washo
        ['cy', 'wel'], // Welsh
        ['', 'wen'], // Sorbian languages
        ['wa', 'wln'], // Walloon
        ['wo', 'wol'], // Wolof
        ['', 'xal'], // Kalmyk; Oirat
        ['xh', 'xho'], // Xhosa
        ['', 'yao'], // Yao
        ['', 'yap'], // Yapese
        ['yi', 'yid'], // Yiddish
        ['yo', 'yor'], // Yoruba
        ['', 'ypk'], // Yupik languages
        ['', 'zap'], // Zapotec
        ['', 'zbl'], // Blissymbols; Blissymbolics; Bliss
        ['', 'zen'], // Zenaga
        ['', 'zgh'], // Standard moroccan tamazight
        ['za', 'zha'], // Zhuang; Chuang
        ['', 'znd'], // Zande languages
        ['zu', 'zul'], // Zulu
        ['', 'zun'], // Zuni
        ['', 'zxx'], // No linguistic content; Not applicable
        ['', 'zza'], // Zaza; Dimili; Dimli; Kirdki; Kirmanjki; Zazaki
    ];

    /**
     * Initializes the rule defining the ISO 639 set.
     *
     * @throws ComponentException
     */
    public function __construct(string $set = self::ALPHA2)
    {
        $index = array_search($set, self::AVAILABLE_SETS, true);
        if (false === $index) {
            throw new ComponentException(sprintf('"%s" is not a valid language set for ISO 639', $set));
        }

        parent::__construct(new In($this->getHaystack($index), true), ['set' => $set]);
    }

    /**
     * @return string[]
     */
    private function getHaystack(int $index): array
    {
        return array_filter(array_column(self::LANGUAGE_CODES, $index));
    }
}
