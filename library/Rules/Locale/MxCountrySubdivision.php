<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Mexico country subdivision.
 *
 * ISO 3166-1 alpha-2: MX
 *
 * @link http://www.geonames.org/MX/administrative-division-mexico.html
 */
class MxCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AGU', // Aguascalientes
        'BCN', // Baja California
        'BCS', // Baja California Sur
        'CAM', // Campeche
        'CHH', // Chihuahua
        'CHP', // Chiapas
        'COA', // Coahuila
        'COL', // Colima
        'DIF', // Distrito Federal
        'DUR', // Durango
        'GRO', // Guerrero
        'GUA', // Guanajuato
        'HID', // Hidalgo
        'JAL', // Jalisco
        'MEX', // Mexico
        'MIC', // Michoacan
        'MOR', // Morelos
        'NAY', // Nayarit
        'NLE', // Nuevo Leon
        'OAX', // Oaxaca
        'PUE', // Puebla
        'QUE', // Queretaro
        'ROO', // Quintana Roo
        'SIN', // Sinaloa
        'SLP', // San Luis Potosi
        'SON', // Sonora
        'TAB', // Tabasco
        'TAM', // Tamaulipas
        'TLA', // Tlaxcala
        'VER', // Veracruz
        'YUC', // Yucatan
        'ZAC', // Zacatecas
    );

    public $compareIdentical = true;
}
