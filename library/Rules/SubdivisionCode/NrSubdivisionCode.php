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
 * Validates whether an input is subdivision code of Nauru or not.
 *
 * ISO 3166-1 alpha-2: NR
 *
 * @see http://www.geonames.org/NR/administrative-division-nauru.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NrSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Aiwo
           '02', // Anabar
           '03', // Anetan
           '04', // Anibare
           '05', // Baiti
           '06', // Boe
           '07', // Buada
           '08', // Denigomodu
           '09', // Ewa
           '10', // Ijuw
           '11', // Meneng
           '12', // Nibok
           '13', // Uaboe
           '14', // Yaren
       ];
    }
}
