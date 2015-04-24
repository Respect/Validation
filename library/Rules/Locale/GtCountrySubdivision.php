<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Guatemala country subdivision.
 *
 * ISO 3166-1 alpha-2: GT
 *
 * @link http://www.geonames.org/GT/administrative-division-guatemala.html
 */
class GtCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AV', // Alta Verapaz
        'BV', // Baja Verapaz
        'CM', // Chimaltenango
        'CQ', // Chiquimula
        'ES', // Escuintla
        'GU', // Guatemala
        'HU', // Huehuetenango
        'IZ', // Izabal
        'JA', // Jalapa
        'JU', // Jutiapa
        'PE', // El Peten
        'PR', // El Progreso
        'QC', // El Quiche
        'QZ', // Quetzaltenango
        'RE', // Retalhuleu
        'SA', // Sacatepequez
        'SM', // San Marcos
        'SO', // Solola
        'SR', // Santa Rosa
        'SU', // Suchitepequez
        'TO', // Totonicapan
        'ZA', // Zacapa
    );

    public $compareIdentical = true;
}
