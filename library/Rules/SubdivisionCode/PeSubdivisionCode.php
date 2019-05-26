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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class PeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AMA', // Amazonas
        'ANC', // Ancash
        'APU', // Apurímac
        'ARE', // Arequipa
        'AYA', // Ayacucho
        'CAJ', // Cajamarca
        'CAL', // El Callao
        'CUS', // Cusco [Cuzco]
        'HUC', // Huánuco
        'HUV', // Huancavelica
        'ICA', // Ica
        'JUN', // Junín
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
        'SAM', // San Martín
        'TAC', // Tacna
        'TUM', // Tumbes
        'UCA', // Ucayali
    ];

    public $compareIdentical = true;
}
