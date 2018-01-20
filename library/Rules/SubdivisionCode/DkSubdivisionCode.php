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
 * Validates whether an input is subdivision code of Denmark or not.
 *
 * ISO 3166-1 alpha-2: DK
 *
 * @see http://www.geonames.org/DK/administrative-division-denmark.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class DkSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '81', // Region Nordjylland
           '82', // Region Midtjylland
           '83', // Region Syddanmark
           '84', // Region Hovedstaden
           '85', // Region Sjæland
       ];
    }
}
