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
 * Validates whether an input is subdivision code of Portugal or not.
 *
 * ISO 3166-1 alpha-2: PT
 *
 * @see http://www.geonames.org/PT/administrative-division-portugal.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class PtSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Aveiro
           '02', // Beja
           '03', // Braga
           '04', // Braganca
           '05', // Castelo Branco
           '06', // Coimbra
           '07', // Evora
           '08', // Faro
           '09', // Guarda
           '10', // Leiria
           '11', // Lisboa
           '12', // Portalegre
           '13', // Porto
           '14', // Santarem
           '15', // Setubal
           '16', // Viana do Castelo
           '17', // Vila Real
           '18', // Viseu
           '20', // Acores (Azores)
           '30', // Madeira
       ];
    }
}
