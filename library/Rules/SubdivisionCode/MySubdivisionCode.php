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
 * Validates whether an input is subdivision code of Malaysia or not.
 *
 * ISO 3166-1 alpha-2: MY
 *
 * @see http://www.geonames.org/MY/administrative-division-malaysia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MySubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Johor
           '02', // Kedah
           '03', // Kelantan
           '04', // Melaka
           '05', // Negeri Sembilan
           '06', // Pahang
           '07', // Pinang
           '08', // Perak
           '09', // Perlis
           '10', // Selangor
           '11', // Terengganu
           '12', // Sabah
           '13', // Sarawak
           '14', // Kuala Lumpur
           '15', // Labuan
           '16', // Putrajaya
       ];
    }
}
