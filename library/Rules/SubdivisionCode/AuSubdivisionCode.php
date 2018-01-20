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
 * Validates whether an input is subdivision code of Australia or not.
 *
 * ISO 3166-1 alpha-2: AU
 *
 * @see http://www.geonames.org/AU/administrative-division-australia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AuSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'ACT', // Australian Capital Territory
           'NSW', // New South Wales
           'NT', // Northern Territory
           'QLD', // Queensland
           'SA', // South Australia
           'TAS', // Tasmania
           'VIC', // Victoria
           'WA', // Western Australia
       ];
    }
}
