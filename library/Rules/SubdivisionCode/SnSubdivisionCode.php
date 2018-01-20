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
 * Validates whether an input is subdivision code of Senegal or not.
 *
 * ISO 3166-1 alpha-2: SN
 *
 * @see http://www.geonames.org/SN/administrative-division-senegal.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SnSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'DB', // Diourbel
           'DK', // Dakar
           'FK', // Fatick
           'KA', // Kaffrine
           'KD', // Kolda
           'KE', // Kédougou
           'KL', // Kaolack
           'LG', // Louga
           'MT', // Matam
           'SE', // Sédhiou
           'SL', // Saint-Louis
           'TC', // Tambacounda
           'TH', // Thies
           'ZG', // Ziguinchor
       ];
    }
}
