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
 * Validates whether an input is subdivision code of Sweden or not.
 *
 * ISO 3166-1 alpha-2: SE
 *
 * @see http://www.geonames.org/SE/administrative-division-sweden.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SeSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AB', // Stockholms
           'AC', // Vasterbottens
           'BD', // Norrbottens
           'C', // Uppsala
           'D', // Sodermanlands
           'E', // Ostergotlands
           'F', // Jonkopings
           'G', // Kronobergs
           'H', // Kalmar
           'I', // Gotlands
           'K', // Blekinge
           'M', // Skåne
           'N', // Hallands
           'O', // Västra Götaland
           'S', // Varmlands
           'T', // Orebro
           'U', // Vastmanlands
           'W', // Dalarna
           'X', // Gavleborgs
           'Y', // Vasternorrlands
           'Z', // Jamtlands
       ];
    }
}
