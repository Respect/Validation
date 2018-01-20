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
 * Validates whether an input is subdivision code of Canada or not.
 *
 * ISO 3166-1 alpha-2: CA
 *
 * @see http://www.geonames.org/CA/administrative-division-canada.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CaSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AB', // Alberta
           'BC', // British Columbia
           'MB', // Manitoba
           'NB', // New Brunswick
           'NL', // Newfoundland and Labrador
           'NS', // Nova Scotia
           'NT', // Northwest Territories
           'NU', // Nunavut
           'ON', // Ontario
           'PE', // Prince Edward Island
           'QC', // Quebec
           'SK', // Saskatchewan
           'YT', // Yukon Territory
       ];
    }
}
