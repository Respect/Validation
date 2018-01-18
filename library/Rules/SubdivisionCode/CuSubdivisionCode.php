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
 * Validates whether an input is subdivision code of Cuba or not.
 *
 * ISO 3166-1 alpha-2: CU
 *
 * @see http://www.geonames.org/CU/administrative-division-cuba.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CuSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Pinar del Rio
           '03', // La Habana
           '04', // Matanzas
           '05', // Villa Clara
           '06', // Cienfuegos
           '07', // Sancti Spiritus
           '08', // Ciego de Avila
           '09', // Camaguey
           '10', // Las Tunas
           '11', // Holguin
           '12', // Granma
           '13', // Santiago de Cuba
           '14', // Guantanamo
           '15', // Artemisa
           '16', // Mayabeque
           '99', // Isla de la Juventud
       ];
    }
}
