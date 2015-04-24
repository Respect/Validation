<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Palau country subdivision.
 *
 * ISO 3166-1 alpha-2: PW
 *
 * @link http://www.geonames.org/PW/administrative-division-palau.html
 */
class PwCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '002', // Aimeliik
        '004', // Airai
        '010', // Angaur
        '050', // Hatohobei
        '100', // Kayangel
        '150', // Koror
        '212', // Melekeok
        '214', // Ngaraard
        '218', // Ngarchelong
        '222', // Ngardmau
        '224', // Ngatpang
        '226', // Ngchesar
        '227', // Ngeremlengui
        '228', // Ngiwal
        '350', // Peleliu
        '370', // Sonsorol
    );

    public $compareIdentical = true;
}
