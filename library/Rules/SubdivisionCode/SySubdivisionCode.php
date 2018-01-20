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
 * Validates whether an input is subdivision code of Syria or not.
 *
 * ISO 3166-1 alpha-2: SY
 *
 * @see http://www.geonames.org/SY/administrative-division-syria.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SySubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'DI', // Dimashq
           'DR', // Dara
           'DY', // Dayr az Zawr
           'HA', // Al Hasakah
           'HI', // Hims
           'HL', // Halab
           'HM', // Hamah
           'ID', // Idlib
           'LA', // Al Ladhiqiyah
           'QU', // Al Qunaytirah
           'RA', // Ar Raqqah
           'RD', // Rif Dimashq
           'SU', // As Suwayda
           'TA', // Tartus
       ];
    }
}
