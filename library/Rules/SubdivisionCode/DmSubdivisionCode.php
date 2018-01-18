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
 * Validates whether an input is subdivision code of Dominica or not.
 *
 * ISO 3166-1 alpha-2: DM
 *
 * @see http://www.geonames.org/DM/administrative-division-dominica.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class DmSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '02', // Saint Andrew Parish
           '03', // Saint David Parish
           '04', // Saint George Parish
           '05', // Saint John Parish
           '06', // Saint Joseph Parish
           '07', // Saint Luke Parish
           '08', // Saint Mark Parish
           '09', // Saint Patrick Parish
           '10', // Saint Paul Parish
           '11', // Saint Peter Parish
       ];
    }
}
