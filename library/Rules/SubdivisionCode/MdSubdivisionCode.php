<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validates whether an input is subdivision code of Moldova or not.
 *
 * ISO 3166-1 alpha-2: MD
 *
 * @see http://www.geonames.org/MD/administrative-division-moldova.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MdSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
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
       ];
    }
}
