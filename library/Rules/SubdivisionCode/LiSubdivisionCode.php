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
 * Validates whether an input is subdivision code of Liechtenstein or not.
 *
 * ISO 3166-1 alpha-2: LI
 *
 * @see http://www.geonames.org/LI/administrative-division-liechtenstein.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LiSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Balzers
           '02', // Eschen
           '03', // Gamprin
           '04', // Mauren
           '05', // Planken
           '06', // Ruggell
           '07', // Schaan
           '08', // Schellenberg
           '09', // Triesen
           '10', // Triesenberg
           '11', // Vaduz
       ];
    }
}
