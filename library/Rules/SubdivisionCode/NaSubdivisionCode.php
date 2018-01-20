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
 * Validates whether an input is subdivision code of Namibia or not.
 *
 * ISO 3166-1 alpha-2: NA
 *
 * @see http://www.geonames.org/NA/administrative-division-namibia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NaSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'CA', // Caprivi
           'ER', // Erongo
           'HA', // Hardap
           'KA', // Karas
           'KE', // Kavango East
           'KH', // Khomas
           'KU', // Kunene
           'KW', // Kavango West
           'OD', // Otjozondjupa
           'OH', // Omaheke
           'ON', // Oshana
           'OS', // Omusati
           'OT', // Oshikoto
           'OW', // Ohangwena
       ];
    }
}
