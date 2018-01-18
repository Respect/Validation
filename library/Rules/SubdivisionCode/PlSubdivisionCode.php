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
 * Validates whether an input is subdivision code of Poland or not.
 *
 * ISO 3166-1 alpha-2: PL
 *
 * @see http://www.geonames.org/PL/administrative-division-poland.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class PlSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'DS', // Dolnoslaskie
           'KP', // Kujawsko-Pomorskie
           'LB', // Lubuskie
           'LD', // Lodzkie
           'LU', // Lubelskie
           'MA', // Malopolskie
           'MZ', // Mazowieckie
           'OP', // Opolskie
           'PD', // Podlaskie
           'PK', // Podkarpackie
           'PM', // Pomorskie
           'SK', // Swietokrzyskie
           'SL', // Slaskie
           'WN', // Warminsko-Mazurskie
           'WP', // Wielkopolskie
           'ZP', // Zachodniopomorskie
       ];
    }
}
