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

use function array_column;
use function array_filter;
use function array_search;
use function sprintf;

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

    public const AVAILABLE_SETS = [self::ALPHA2, self::ALPHA3];

    /**
     * @see http://www.loc.gov/standards/iso639-2/ISO-639-2_utf-8.txt
     */
    public const LANGUAGE_CODES = [
        // phpcs:disable Squiz.PHP.CommentedOutCode.Found
        ['aa', 'aar'], // Afar
        ['ab', 'abk'], // Abkhazian
        ['', 'ace'], // Achinese
        ['', 'ach'], // Acoli
        ['', 'ada'], // Adangme
        ['', 'ady'], // Adyghe; Adygei
        ['', 'afa'], // Afro-Asiatic languages
        ['', 'afh'], // Afrihili
        ['af', 'afr'], // Afrikaans
        ['', 'ain'], // Ainu
        ['ak', 'aka'], // Akan
        ['', 'akk'], // Akkadian
        ['sq', 'alb'], // Albanian
        ['', 'ale'], // Aleut
        ['', 'alg'], // Algonquian languages
        ['', 'alt'], // Southern Altai
        ['am', 'amh'], // Amharic
        ['', 'ang'], // English, Old (ca.450-1100)
        ['', 'anp'], // Angika
        ['', 'apa'], // Apache languages
        ['ar', 'ara'], // Arabic
        ['', 'arc'], // Official Aramaic (700-300 BCE); Imperial Aramaic (700-300 BCE)
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
        ['', 'bnt'], // Bantu languages
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
        ['', 'cai'], // Central American Indian languages
        ['', 'car'], // Galibi Carib
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
        ['', 'chp'], // Chipewyan; Dene Suline
        ['', 'chr'], // Cherokee
        ['cu', 'chu'], // Church Slavic; Old Slavonic; Church Slavonic; Old Bulgarian; Old Church Slavonic
        ['cv', 'chv'], // Chuvash
        ['', 'chy'], // Cheyenne
        ['', 'cmc'], // Chamic languages
        ['', 'cnr'], // Montenegrin
        ['', 'cop'], // Coptic
        ['kw', 'cor'], // Cornish
        ['co', 'cos'], // Corsican
        ['', 'cpe'], // Creoles and pidgins, English based
        ['', 'cpf'], // Creoles and pidgins, French-based
        ['', 'cpp'], // Creoles and pidgins, Portuguese-based
        ['cr', 'cre'], // Cree
        ['', 'crh'], // Crimean Tatar; Crimean Turkish
        ['', 'crp'], // Creoles and pidgins
        ['', 'csb'], // Kashubian
        ['', 'cus'], // Cushitic languages
        ['cs', 'cze'], // Czech
        ['', 'dak'], // Dakota
        ['da', 'dan'], // Danish
        ['', 'dar'], // Dargwa
        ['', 'day'], // Land Dayak languages
        ['', 'del'], // Delaware
        ['', 'den'], // Slave (Athapascan)
        ['', 'dgr'], // Dogrib
        ['', 'din'], // Dinka
        ['dv', 'div'], // Divehi; Dhivehi; Maldivian
        ['', 'doi'], // Dogri
        ['', 'dra'], // Dravidian languages
        ['', 'dsb'], // Lower Sorbian
        ['', 'dua'], // Duala
        ['', 'dum'], // Dutch, Middle (ca.1050-1350)
        ['nl', 'dut'], // Dutch; Flemish
        ['', 'dyu'], // Dyula
        ['dz', 'dzo'], // Dzongkha
        ['', 'efi'], // Efik
        ['', 'egy'], // Egyptian (Ancient)
        ['', 'eka'], // Ekajuk
        ['', 'elx'], // Elamite
        ['en', 'eng'], // English
        ['', 'enm'], // English, Middle (1100-1500)
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
        ['', 'fiu'], // Finno-Ugrian languages
        ['', 'fon'], // Fon
        ['fr', 'fre'], // French
        ['', 'frm'], // French, Middle (ca.1400-1600)
        ['', 'fro'], // French, Old (842-ca.1400)
        ['', 'frr'], // Northern Frisian
        ['', 'frs'], // Eastern Frisian
        ['fy', 'fry'], // Western Frisian
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
        ['gd', 'gla'], // Gaelic; Scottish Gaelic
        ['ga', 'gle'], // Irish
        ['gl', 'glg'], // Galician
        ['gv', 'glv'], // Manx
        ['', 'gmh'], // German, Middle High (ca.1050-1500)
        ['', 'goh'], // German, Old High (ca.750-1050)
        ['', 'gon'], // Gondi
        ['', 'gor'], // Gorontalo
        ['', 'got'], // Gothic
        ['', 'grb'], // Grebo
        ['', 'grc'], // Greek, Ancient (to 1453)
        ['el', 'gre'], // Greek, Modern (1453-)
        ['gn', 'grn'], // Guarani
        ['', 'gsw'], // Swiss German; Alemannic; Alsatian
        ['gu', 'guj'], // Gujarati
        ['', 'gwi'], // Gwich'in
        ['', 'hai'], // Haida
        ['ht', 'hat'], // Haitian; Haitian Creole
        ['ha', 'hau'], // Hausa
        ['', 'haw'], // Hawaiian
        ['he', 'heb'], // Hebrew
        ['hz', 'her'], // Herero
        ['', 'hil'], // Hiligaynon
        ['', 'him'], // Himachali languages; Western Pahari languages
        ['hi', 'hin'], // Hindi
        ['', 'hit'], // Hittite
        ['', 'hmn'], // Hmong; Mong
        ['ho', 'hmo'], // Hiri Motu
        ['hr', 'hrv'], // Croatian
        ['', 'hsb'], // Upper Sorbian
        ['hu', 'hun'], // Hungarian
        ['', 'hup'], // Hupa
        ['', 'iba'], // Iban
        ['ig', 'ibo'], // Igbo
        ['is', 'ice'], // Icelandic
        ['io', 'ido'], // Ido
        ['ii', 'iii'], // Sichuan Yi; Nuosu
        ['', 'ijo'], // Ijo languages
        ['iu', 'iku'], // Inuktitut
        ['ie', 'ile'], // Interlingue; Occidental
        ['', 'ilo'], // Iloko
        ['ia', 'ina'], // Interlingua (International Auxiliary Language Association)
        ['', 'inc'], // Indic languages
        ['id', 'ind'], // Indonesian
        ['', 'ine'], // Indo-European languages
        ['', 'inh'], // Ingush
        ['ik', 'ipk'], // Inupiaq
        ['', 'ira'], // Iranian languages
        ['', 'iro'], // Iroquoian languages
        ['it', 'ita'], // Italian
        ['jv', 'jav'], // Javanese
        ['', 'jbo'], // Lojban
        ['ja', 'jpn'], // Japanese
        ['', 'jpr'], // Judeo-Persian
        ['', 'jrb'], // Judeo-Arabic
        ['', 'kaa'], // Kara-Kalpak
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
        ['km', 'khm'], // Central Khmer
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
        ['', 'krc'], // Karachay-Balkar
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
        ['', 'lua'], // Luba-Lulua
        ['lu', 'lub'], // Luba-Katanga
        ['lg', 'lug'], // Ganda
        ['', 'lui'], // Luiseno
        ['', 'lun'], // Lunda
        ['', 'luo'], // Luo (Kenya and Tanzania)
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
        ['', 'mga'], // Irish, Middle (900-1200)
        ['', 'mic'], // Mi'kmaq; Micmac
        ['', 'min'], // Minangkabau
        ['', 'mis'], // Uncoded languages
        ['', 'mkh'], // Mon-Khmer languages
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
        ['', 'nai'], // North American Indian languages
        ['', 'nap'], // Neapolitan
        ['na', 'nau'], // Nauru
        ['nv', 'nav'], // Navajo; Navaho
        ['nr', 'nbl'], // Ndebele, South; South Ndebele
        ['nd', 'nde'], // Ndebele, North; North Ndebele
        ['ng', 'ndo'], // Ndonga
        ['', 'nds'], // Low German; Low Saxon; German, Low; Saxon, Low
        ['ne', 'nep'], // Nepali
        ['', 'new'], // Nepal Bhasa; Newari
        ['', 'nia'], // Nias
        ['', 'nic'], // Niger-Kordofanian languages
        ['', 'niu'], // Niuean
        ['nn', 'nno'], // Norwegian Nynorsk; Nynorsk, Norwegian
        ['nb', 'nob'], // Bokmål, Norwegian; Norwegian Bokmål
        ['', 'nog'], // Nogai
        ['', 'non'], // Norse, Old
        ['no', 'nor'], // Norwegian
        ['', 'nqo'], // N'Ko
        ['', 'nso'], // Pedi; Sepedi; Northern Sotho
        ['', 'nub'], // Nubian languages
        ['', 'nwc'], // Classical Newari; Old Newari; Classical Nepal Bhasa
        ['ny', 'nya'], // Chichewa; Chewa; Nyanja
        ['', 'nym'], // Nyamwezi
        ['', 'nyn'], // Nyankole
        ['', 'nyo'], // Nyoro
        ['', 'nzi'], // Nzima
        ['oc', 'oci'], // Occitan (post 1500)
        ['oj', 'oji'], // Ojibwa
        ['or', 'ori'], // Oriya
        ['om', 'orm'], // Oromo
        ['', 'osa'], // Osage
        ['os', 'oss'], // Ossetian; Ossetic
        ['', 'ota'], // Turkish, Ottoman (1500-1928)
        ['', 'oto'], // Otomian languages
        ['', 'paa'], // Papuan languages
        ['', 'pag'], // Pangasinan
        ['', 'pal'], // Pahlavi
        ['', 'pam'], // Pampanga; Kapampangan
        ['pa', 'pan'], // Panjabi; Punjabi
        ['', 'pap'], // Papiamento
        ['', 'pau'], // Palauan
        ['', 'peo'], // Persian, Old (ca.600-400 B.C.)
        ['fa', 'per'], // Persian
        ['', 'phi'], // Philippine languages
        ['', 'phn'], // Phoenician
        ['pi', 'pli'], // Pali
        ['pl', 'pol'], // Polish
        ['', 'pon'], // Pohnpeian
        ['pt', 'por'], // Portuguese
        ['', 'pra'], // Prakrit languages
        ['', 'pro'], // Provençal, Old (to 1500); Occitan, Old (to 1500)
        ['ps', 'pus'], // Pushto; Pashto
        ['', 'qaaqtz'], // Reserved for local use
        ['qu', 'que'], // Quechua
        ['', 'raj'], // Rajasthani
        ['', 'rap'], // Rapanui
        ['', 'rar'], // Rarotongan; Cook Islands Maori
        ['', 'roa'], // Romance languages
        ['rm', 'roh'], // Romansh
        ['', 'rom'], // Romany
        ['ro', 'rum'], // Romanian; Moldavian; Moldovan
        ['rn', 'run'], // Rundi
        ['', 'rup'], // Aromanian; Arumanian; Macedo-Romanian
        ['ru', 'rus'], // Russian
        ['', 'sad'], // Sandawe
        ['sg', 'sag'], // Sango
        ['', 'sah'], // Yakut
        ['', 'sai'], // South American Indian languages
        ['', 'sal'], // Salishan languages
        ['', 'sam'], // Samaritan Aramaic
        ['sa', 'san'], // Sanskrit
        ['', 'sas'], // Sasak
        ['', 'sat'], // Santali
        ['', 'scn'], // Sicilian
        ['', 'sco'], // Scots
        ['', 'sel'], // Selkup
        ['', 'sem'], // Semitic languages
        ['', 'sga'], // Irish, Old (to 900)
        ['', 'sgn'], // Sign Languages
        ['', 'shn'], // Shan
        ['', 'sid'], // Sidamo
        ['si', 'sin'], // Sinhala; Sinhalese
        ['', 'sio'], // Siouan languages
        ['', 'sit'], // Sino-Tibetan languages
        ['', 'sla'], // Slavic languages
        ['sk', 'slo'], // Slovak
        ['sl', 'slv'], // Slovenian
        ['', 'sma'], // Southern Sami
        ['se', 'sme'], // Northern Sami
        ['', 'smi'], // Sami languages
        ['', 'smj'], // Lule Sami
        ['', 'smn'], // Inari Sami
        ['sm', 'smo'], // Samoan
        ['', 'sms'], // Skolt Sami
        ['sn', 'sna'], // Shona
        ['sd', 'snd'], // Sindhi
        ['', 'snk'], // Soninke
        ['', 'sog'], // Sogdian
        ['so', 'som'], // Somali
        ['', 'son'], // Songhai languages
        ['st', 'sot'], // Sotho, Southern
        ['es', 'spa'], // Spanish; Castilian
        ['sc', 'srd'], // Sardinian
        ['', 'srn'], // Sranan Tongo
        ['sr', 'srp'], // Serbian
        ['', 'srr'], // Serer
        ['', 'ssa'], // Nilo-Saharan languages
        ['ss', 'ssw'], // Swati
        ['', 'suk'], // Sukuma
        ['su', 'sun'], // Sundanese
        ['', 'sus'], // Susu
        ['', 'sux'], // Sumerian
        ['sw', 'swa'], // Swahili
        ['sv', 'swe'], // Swedish
        ['', 'syc'], // Classical Syriac
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
        ['', 'tlh'], // Klingon; tlhIngan-Hol
        ['', 'tli'], // Tlingit
        ['', 'tmh'], // Tamashek
        ['', 'tog'], // Tonga (Nyasa)
        ['to', 'ton'], // Tonga (Tonga Islands)
        ['', 'tpi'], // Tok Pisin
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
        ['', 'wal'], // Wolaitta; Wolaytta
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
        ['', 'zgh'], // Standard Moroccan Tamazight
        ['za', 'zha'], // Zhuang; Chuang
        ['', 'znd'], // Zande languages
        ['zu', 'zul'], // Zulu
        ['', 'zun'], // Zuni
        ['', 'zxx'], // No linguistic content; Not applicable
        // phpcs:enable Squiz.PHP.CommentedOutCode.Found
    ];

    /**
     * Initializes the rule defining the ISO 639 set.
     *
     * @throws ComponentException
     */
    public function __construct(string $set = self::ALPHA2)
    {
        $index = array_search($set, self::AVAILABLE_SETS, true);
        if ($index === false) {
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
