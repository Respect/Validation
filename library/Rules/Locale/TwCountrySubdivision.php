<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Taiwan country subdivision.
 *
 * ISO 3166-1 alpha-2: TW
 *
 * @link http://www.geonames.org/TW/administrative-division-taiwan.html
 */
class TwCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'CHA', // Changhua
        'CYI', // Chiayi
        'CYQ', // Chiayi
        'HSQ', // Hsinchu
        'HSZ', // Hsinchu
        'HUA', // Hualien
        'ILA', // Ilan
        'KEE', // Keelung
        'KHH', // Kaohsiung
        'MIA', // Miaoli
        'NAN', // Nantou
        'PEN', // Penghu
        'PIF', // Pingtung
        'TAO', // Taoyuan
        'TNN', // Tainan
        'TPE', // Taipei
        'TPQ', // New Taipei
        'TTT', // Taitung
        'TXG', // Taichung
        'YUN', // Yunlin
        'TXQ', // Taichung County
    );

    public $compareIdentical = true;
}
