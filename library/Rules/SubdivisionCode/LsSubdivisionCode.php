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
 * Validates whether an input is subdivision code of Lesotho or not.
 *
 * ISO 3166-1 alpha-2: LS
 *
 * @see http://www.geonames.org/LS/administrative-division-lesotho.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LsSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'A', // Maseru
           'B', // Butha-Buthe
           'C', // Leribe
           'D', // Berea
           'E', // Mafeteng
           'F', // Mohale's Hoek
           'G', // Quthing
           'H', // Qacha's Nek
           'J', // Mokhotlong
           'K', // Thaba-Tseka
       ];
    }
}
