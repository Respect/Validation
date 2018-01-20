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
 * Validates whether an input is subdivision code of South Africa or not.
 *
 * ISO 3166-1 alpha-2: ZA
 *
 * @see http://www.geonames.org/ZA/administrative-division-south-africa.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ZaSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'EC', // Eastern Cape
           'FS', // Free State
           'GT', // Gauteng
           'LP', // Limpopo
           'MP', // Mpumalanga
           'NC', // Northern Cape
           'NL', // KwaZulu-Natal
           'NW', // North West
           'WC', // Western Cape
       ];
    }
}
