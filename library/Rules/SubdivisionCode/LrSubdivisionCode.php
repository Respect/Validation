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
 * Validates whether an input is subdivision code of Liberia or not.
 *
 * ISO 3166-1 alpha-2: LR
 *
 * @see http://www.geonames.org/LR/administrative-division-liberia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LrSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BG', // Bong
           'BM', // Bomi
           'CM', // Grand Cape Mount
           'GB', // Grand Bassa
           'GG', // Grand Gedeh
           'GK', // Grand Kru
           'GP', // Gbarpolu
           'LO', // Lofa
           'MG', // Margibi
           'MO', // Montserrado
           'MY', // Maryland
           'NI', // Nimba
           'RG', // River Gee
           'RI', // River Cess
           'SI', // Sinoe
       ];
    }
}
