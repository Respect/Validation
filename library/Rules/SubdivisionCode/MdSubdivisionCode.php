<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Moldova subdivision code.
 *
 * ISO 3166-1 alpha-2: MD
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class MdSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AN', // Anenii Noi
        'BA', // Bălți
        'BD', // Tighina
        'BR', // Briceni
        'BS', // Basarabeasca
        'CA', // Cahul
        'CL', // Călărași
        'CM', // Cimișlia
        'CR', // Criuleni
        'CS', // Căușeni
        'CT', // Cantemir
        'CU', // Chișinău
        'DO', // Dondușeni
        'DR', // Drochia
        'DU', // Dubăsari
        'ED', // Edineț
        'FA', // Fălești
        'FL', // Florești
        'GA', // Găgăuzia, Unitatea teritorială autonomă
        'GL', // Glodeni
        'HI', // Hîncești
        'IA', // Ialoveni
        'LE', // Leova
        'NI', // Nisporeni
        'OC', // Ocnița
        'OR', // Orhei
        'RE', // Rezina
        'RI', // Rîșcani
        'SD', // Șoldănești
        'SI', // Sîngerei
        'SN', // Stînga Nistrului, unitatea teritorială din
        'SO', // Soroca
        'ST', // Strășeni
        'SV', // Ștefan Vodă
        'TA', // Taraclia
        'TE', // Telenești
        'UN', // Ungheni
    ];

    public $compareIdentical = true;
}
