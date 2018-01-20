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
 * Validates whether an input is subdivision code of El Salvador or not.
 *
 * ISO 3166-1 alpha-2: SV
 *
 * @see http://www.geonames.org/SV/administrative-division-el-salvador.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SvSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AH', // Ahuachapan
           'CA', // Cabanas
           'CH', // Chalatenango
           'CU', // Cuscatlan
           'LI', // La Libertad
           'MO', // Morazan
           'PA', // La Paz
           'SA', // Santa Ana
           'SM', // San Miguel
           'SO', // Sonsonate
           'SS', // San Salvador
           'SV', // San Vicente
           'UN', // La Union
           'US', // Usulutan
       ];
    }
}
