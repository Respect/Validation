<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Azerbaijan country subdivision.
 *
 * ISO 3166-1 alpha-2: AZ
 *
 * @link http://www.geonames.org/AZ/administrative-division-azerbaijan.html
 */
class AzCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AB', // Şirvan
        'ABS', // Abseron
        'AGA', // Agstafa
        'AGC', // AgcabAdi
        'AGM', // Agdam
        'AGS', // Agdas
        'AGU', // Agsu
        'AST', // Astara
        'BA', // Baki
        'BAL', // BalakAn
        'BAR', // Barda
        'BEY', // Beylaqan
        'BIL', // Bilasuvar
        'CAB', // Cabrayil
        'CAL', // Calilabab
        'DAS', // Daskasan
        'DAV', // Şabran
        'FUZ', // Fuzuli
        'GA', // Ganca
        'GAD', // Gadabay
        'GOR', // Goranboy
        'GOY', // Goycay
        'HAC', // Haciqabul
        'IMI', // Imisli
        'ISM', // Ismayilli
        'KAL', // Kalbacar
        'KAN', // Kəngərli
        'KUR', // Kurdamir
        'LA', // Lankaran
        'LAC', // Lacin
        'LAN', // Lankaran Sahari
        'LER', // Lerik
        'MAS', // Masalli
        'MI', // Mingəçevir
        'NA', // Naftalan
        'NEF', // Neftcala
        'NV', // Naxçivan
        'NX', // Naxcivan
        'OGU', // Oguz
        'QAB', // Qabala
        'QAX', // Qax
        'QAZ', // Qazax
        'QBA', // Quba
        'QBI', // Qubadli
        'QOB', // Qobustan
        'QUS', // Qusar
        'SA', // Saki
        'SAB', // Sabirabad
        'SAK', // Saki Sahari
        'SAL', // Salyan
        'SAT', // Saatli
        'SIY', // Siyazan
        'SKR', // Samkir
        'SM', // Sumqayit
        'SMI', // Samaxi
        'SMX', // Samux
        'SS', // Susa
        'SUS', // Susa Sahari
        'TAR', // Tartar
        'TOV', // Tovuz
        'UCA', // Ucar
        'XA', // Xankandi
        'XAC', // Xacmaz
        'XAN', // Göygöl
        'XCI', // Xocali
        'XIZ', // Xizi
        'XVD', // Xocavand
        'YAR', // Yardimli
        'YE', // Yevlax Sahari
        'YEV', // Yevlax
        'ZAN', // Zangilan
        'ZAQ', // Zaqatala
        'ZAR', // Zardab
        'BAB', // Babek
        'CUL', // Culfa
        'ORD', // Ordubad
        'SAD', // Sadarak
        'SAH', // Sahbuz
        'SAR', // Sarur
    );

    public $compareIdentical = true;
}
