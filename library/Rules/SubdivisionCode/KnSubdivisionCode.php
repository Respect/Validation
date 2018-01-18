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
 * Validates whether an input is subdivision code of Saint Kitts and Nevis or not.
 *
 * ISO 3166-1 alpha-2: KN
 *
 * @see http://www.geonames.org/KN/administrative-division-saint-kitts-and-nevis.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KnSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Christ Church Nichola Town
           '02', // Saint Anne Sandy Point
           '03', // Saint George Basseterre
           '04', // Saint George Gingerland
           '05', // Saint James Windward
           '06', // Saint John Capesterre
           '07', // Saint John Figtree
           '08', // Saint Mary Cayon
           '09', // Saint Paul Capesterre
           '10', // Saint Paul Charlestown
           '11', // Saint Peter Basseterre
           '12', // Saint Thomas Lowland
           '13', // Saint Thomas Middle Island
           '15', // Trinity Palmetto Point
           'K', // Saint Kitts
           'N', // Nevis
       ];
    }
}
