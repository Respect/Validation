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
 * Validates whether an input is subdivision code of Zambia or not.
 *
 * ISO 3166-1 alpha-2: ZM
 *
 * @see http://www.geonames.org/ZM/administrative-division-zambia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ZmSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Western Province
           '02', // Central Province
           '03', // Eastern Province
           '04', // Luapula Province
           '05', // Northern Province
           '06', // North-Western Province
           '07', // Southern Province
           '08', // Copperbelt Province
           '09', // Lusaka Province
           '10', // Muchinga
       ];
    }
}
