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
 * Validates whether an input is subdivision code of Ecuador or not.
 *
 * ISO 3166-1 alpha-2: EC
 *
 * @see http://www.geonames.org/EC/administrative-division-ecuador.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class EcSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'A', // Azuay
           'B', // Bolivar
           'C', // Carchi
           'D', // Orellana
           'E', // Esmeraldas
           'F', // Canar
           'G', // Guayas
           'H', // Chimborazo
           'I', // Imbabura
           'L', // Loja
           'M', // Manabi
           'N', // Napo
           'O', // El Oro
           'P', // Pichincha
           'R', // Los Rios
           'S', // Morona-Santiago
           'SD', // Santo Domingo de los Tsáchilas
           'SE', // Santa Elena
           'T', // Tungurahua
           'U', // Sucumbios
           'W', // Galapagos
           'X', // Cotopaxi
           'Y', // Pastaza
           'Z', // Zamora-Chinchipe
       ];
    }
}
