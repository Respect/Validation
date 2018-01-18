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
 * Validates whether an input is subdivision code of Honduras or not.
 *
 * ISO 3166-1 alpha-2: HN
 *
 * @see http://www.geonames.org/HN/administrative-division-honduras.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class HnSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AT', // Atlantida
           'CH', // Choluteca
           'CL', // Colon
           'CM', // Comayagua
           'CP', // Copan
           'CR', // Cortes
           'EP', // El Paraiso
           'FM', // Francisco Morazan
           'GD', // Gracias a Dios
           'IB', // Islas de la Bahia (Bay Islands)
           'IN', // Intibuca
           'LE', // Lempira
           'LP', // La Paz
           'OC', // Ocotepeque
           'OL', // Olancho
           'SB', // Santa Barbara
           'VA', // Valle
           'YO', // Yoro
       ];
    }
}
