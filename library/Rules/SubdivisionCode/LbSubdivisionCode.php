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
 * Validates whether an input is subdivision code of Lebanon or not.
 *
 * ISO 3166-1 alpha-2: LB
 *
 * @see http://www.geonames.org/LB/administrative-division-lebanon.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LbSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AK', // Aakkâr
           'AS', // Liban-Nord
           'BA', // Beyrouth
           'BH', // Baalbek-Hermel
           'BI', // Béqaa
           'JA', // Liban-Sud
           'JL', // Mont-Liban
           'NA', // Nabatîyé
       ];
    }
}
