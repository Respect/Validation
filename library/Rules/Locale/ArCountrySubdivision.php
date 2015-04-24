<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Argentina country subdivision.
 *
 * ISO 3166-1 alpha-2: AR
 *
 * @link http://www.geonames.org/AR/administrative-division-argentina.html
 */
class ArCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'A', // Salta
        'B', // Buenos Aires Province
        'C', // Ciudad Autónoma de Buenos Aires
        'D', // San Luis
        'E', // Entre Rios
        'F', // La Rioja
        'G', // Santiago del Estero
        'H', // Chaco
        'J', // San Juan
        'K', // Catamarca
        'L', // La Pampa
        'M', // Mendoza
        'N', // Misiones
        'P', // Formosa
        'Q', // Neuquen
        'R', // Rio Negro
        'S', // Santa Fe
        'T', // Tucuman
        'U', // Chubut
        'V', // Tierra del Fuego
        'W', // Corrientes
        'X', // Cordoba
        'Y', // Jujuy
        'Z', // Santa Cruz
    );

    public $compareIdentical = true;
}
