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
 * Validates whether an input is subdivision code of Ghana or not.
 *
 * ISO 3166-1 alpha-2: GH
 *
 * @see http://www.geonames.org/GH/administrative-division-ghana.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class GhSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AA', // Greater Accra Region
           'AH', // Ashanti Region
           'BA', // Brong-Ahafo Region
           'CP', // Central Region
           'EP', // Eastern Region
           'NP', // Northern Region
           'TV', // Volta Region
           'UE', // Upper East Region
           'UW', // Upper West Region
           'WP', // Western Region
       ];
    }
}
