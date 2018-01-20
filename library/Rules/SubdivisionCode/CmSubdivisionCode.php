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
 * Validates whether an input is subdivision code of Cameroon or not.
 *
 * ISO 3166-1 alpha-2: CM
 *
 * @see http://www.geonames.org/CM/administrative-division-cameroon.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CmSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AD', // Adamawa Province (Adamaoua)
           'CE', // Centre Province
           'EN', // Extreme North Province (Extrême-Nord)
           'ES', // East Province (Est)
           'LT', // Littoral Province
           'NO', // North Province (Nord)
           'NW', // Northwest Province (Nord-Ouest)
           'OU', // West Province (Ouest)
           'SU', // South Province (Sud)
           'SW', // Southwest Province (Sud-Ouest).
       ];
    }
}
