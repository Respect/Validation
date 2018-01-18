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
 * Validates whether an input is subdivision code of Sudan or not.
 *
 * ISO 3166-1 alpha-2: SD
 *
 * @see http://www.geonames.org/SD/administrative-division-sudan.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SdSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'DC', // Wasaţ Dārfūr
           'DE', // Sharq Dārfūr
           'DN', // Shamāl Dārfūr
           'DS', // Janūb Dārfūr
           'DW', // Gharb Dārfūr
           'GD', // Al Qaḑārif
           'GK', // West Kurdufan
           'GZ', // Al Jazīrah
           'KA', // Kassalā
           'KH', // Al Kharţūm
           'KN', // Shamāl Kurdufān
           'KS', // Janūb Kurdufān
           'NB', // An Nīl al Azraq
           'NO', // Ash Shamālīyah
           'NR', // An Nīl
           'NW', // An Nīl al Abyaḑ
           'RS', // Al Baḩr al Aḩmar
           'SI', // Sinnār
       ];
    }
}
