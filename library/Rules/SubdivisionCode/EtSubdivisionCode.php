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
 * Validates whether an input is subdivision code of Ethiopia or not.
 *
 * ISO 3166-1 alpha-2: ET
 *
 * @see http://www.geonames.org/ET/administrative-division-ethiopia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class EtSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AA', // Addis Ababa
           'AF', // Afar
           'AM', // Amhara
           'BE', // Benishangul-Gumaz
           'DD', // Dire Dawa
           'GA', // Gambela
           'HA', // Hariai
           'OR', // Oromia
           'SN', // Southern Nations - Nationalities and Peoples Region
           'SO', // Somali
           'TI', // Tigray
       ];
    }
}
