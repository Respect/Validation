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
 * Validates whether an input is subdivision code of Romania or not.
 *
 * ISO 3166-1 alpha-2: RO
 *
 * @see http://www.geonames.org/RO/administrative-division-romania.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class RoSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AB', // Alba
           'AG', // Arges
           'AR', // Arad
           'B', // Bucuresti
           'BC', // Bacau
           'BH', // Bihor
           'BN', // Bistrita-Nasaud
           'BR', // Braila
           'BT', // Botosani
           'BV', // Brasov
           'BZ', // Buzau
           'CJ', // Cluj
           'CL', // Calarasi
           'CS', // Caras-Severin
           'CT', // Constanta
           'CV', // Covasna
           'DB', // Dimbovita
           'DJ', // Dolj
           'GJ', // Gorj
           'GL', // Galati
           'GR', // Giurgiu
           'HD', // Hunedoara
           'HR', // Harghita
           'IF', // Ilfov
           'IL', // Ialomita
           'IS', // Iasi
           'MH', // Mehedinti
           'MM', // Maramures
           'MS', // Mures
           'NT', // Neamt
           'OT', // Olt
           'PH', // Prahova
           'SB', // Sibiu
           'SJ', // Salaj
           'SM', // Satu Mare
           'SV', // Suceava
           'TL', // Tulcea
           'TM', // Timis
           'TR', // Teleorman
           'VL', // Vilcea
           'VN', // Vrancea
           'VS', // Vaslui
       ];
    }
}
