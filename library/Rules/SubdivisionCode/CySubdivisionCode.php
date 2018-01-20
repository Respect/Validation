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
 * Validates whether an input is subdivision code of Cyprus or not.
 *
 * ISO 3166-1 alpha-2: CY
 *
 * @see http://www.geonames.org/CY/administrative-division-cyprus.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CySubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Lefkosía
           '02', // Lemesós
           '03', // Lárnaka
           '04', // Ammóchostos
           '05', // Páfos
           '06', // Kerýneia
       ];
    }
}
