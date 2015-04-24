<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Moldova country subdivision.
 *
 * ISO 3166-1 alpha-2: MD
 *
 * @link http://www.geonames.org/MD/administrative-division-moldova.html
 */
class MdCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        'AN', // Raionul Anenii Noi
        'BA', // Municipiul Bălţi
        'BD', // Tighina
        'BR', // Raionul Briceni
        'BS', // Raionul Basarabeasca
        'CA', // Cahul
        'CL', // Raionul Călăraşi
        'CM', // Raionul Cimişlia
        'CR', // Raionul Criuleni
        'CS', // Raionul Căuşeni
        'CT', // Raionul Cantemir
        'CU', // Municipiul Chişinău
        'DO', // Donduşeni
        'DR', // Raionul Drochia
        'DU', // Dubăsari
        'ED', // Raionul Edineţ
        'FA', // Făleşti
        'FL', // Floreşti
        'GA', // U.T.A. Găgăuzia
        'GL', // Raionul Glodeni
        'HI', // Hînceşti
        'IA', // Ialoveni
        'LE', // Leova
        'NI', // Nisporeni
        'OC', // Raionul Ocniţa
        'OR', // Raionul Orhei
        'RE', // Rezina
        'RI', // Rîşcani
        'SD', // Raionul Şoldăneşti
        'SI', // Sîngerei
        'SN', // Stînga Nistrului
        'SO', // Soroca
        'ST', // Raionul Străşeni
        'SV', // Raionul Ştefan Vodă
        'TA', // Raionul Taraclia
        'TE', // Teleneşti
        'UN', // Raionul Ungheni
    );

    public $compareIdentical = true;
}
