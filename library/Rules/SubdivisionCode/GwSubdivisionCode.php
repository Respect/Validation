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
 * Validates whether an input is subdivision code of Guinea-Bissau or not.
 *
 * ISO 3166-1 alpha-2: GW
 *
 * @see http://www.geonames.org/GW/administrative-division-guinea-bissau.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class GwSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BA', // Bafata Region
           'BL', // Bolama Region
           'BM', // Biombo Region
           'BS', // Bissau Region
           'CA', // Cacheu Region
           'GA', // Gabu Region
           'L', // Leste
           'N', // Norte
           'OI', // Oio Region
           'QU', // Quinara Region
           'S', // Sul
           'TO', // Tombali Region
       ];
    }
}
