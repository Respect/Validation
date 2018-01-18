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
 * Validates whether an input is subdivision code of Peru or not.
 *
 * ISO 3166-1 alpha-2: PE
 *
 * @see http://www.geonames.org/PE/administrative-division-peru.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class PeSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
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
    }
}
