<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Nicaragua country subdivision.
 *
 * ISO 3166-1 alpha-2: NI
 *
 * @link http://www.geonames.org/NI/administrative-division-nicaragua.html
 */
class NiCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AN', // Region Autonoma del Atlantico Norte
        'AS', // Region Autonoma del Atlantico Sur
        'BO', // Boaco
        'CA', // Carazo
        'CI', // Chinandega
        'CO', // Chontales
        'ES', // Esteli
        'GR', // Granada
        'JI', // Jinotega
        'LE', // Leon
        'MD', // Madriz
        'MN', // Managua
        'MS', // Masaya
        'MT', // Matagalpa
        'NS', // Nueva Segovia
        'RI', // Rivas
        'SJ', // Rio San Juan
    );

    public $compareIdentical = true;
}
