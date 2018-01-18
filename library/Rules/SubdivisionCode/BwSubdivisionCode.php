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
 * Validates whether an input is subdivision code of Botswana or not.
 *
 * ISO 3166-1 alpha-2: BW
 *
 * @see http://www.geonames.org/BW/administrative-division-botswana.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BwSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'CE', // Central
           'CH', // Chobe
           'FR', // Francistown
           'GA', // Gaborone
           'GH', // Ghanzi
           'JW', // Jwaneng
           'KG', // Kgalagadi
           'KL', // Kgatleng
           'KW', // Kweneng
           'LO', // Lobatse
           'NE', // North East
           'NW', // North West
           'SE', // South East
           'SO', // Southern
           'SP', // Selibe Phikwe
           'ST', // Sowa Town
       ];
    }
}
