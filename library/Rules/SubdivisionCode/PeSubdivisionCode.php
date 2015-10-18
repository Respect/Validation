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
 * Validator for Peru subdivision code.
 *
 * ISO 3166-1 alpha-2: PE
 *
 * @link http://www.geonames.org/PE/administrative-division-peru.html
 */
class PeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AMA', // Amazonas
        'ANC', // Ancash
        'APU', // Apurimac
        'ARE', // Arequipa
        'AYA', // Ayacucho
        'CAJ', // Cajamarca
        'CAL', // Callao
        'CUS', // Cusco
        'HUC', // Huanuco
        'HUV', // Huancavelica
        'ICA', // Ica
        'JUN', // Junin
        'LAL', // La Libertad
        'LAM', // Lambayeque
        'LIM', // Lima
        'LMA', // Municipalidad Metropolitana de Lima
        'LOR', // Loreto
        'MDD', // Madre de Dios
        'MOQ', // Moquegua
        'PAS', // Pasco
        'PIU', // Piura
        'PUN', // Puno
        'SAM', // San Martin
        'TAC', // Tacna
        'TUM', // Tumbes
        'UCA', // Ucayali
    ];

    public $compareIdentical = true;
}
