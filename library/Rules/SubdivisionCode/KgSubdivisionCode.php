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
 * Validates whether an input is subdivision code of Kyrgyzstan or not.
 *
 * ISO 3166-1 alpha-2: KG
 *
 * @see http://www.geonames.org/KG/administrative-division-kyrgyzstan.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KgSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'B', // Batken
           'C', // Chu
           'GB', // Bishkek
           'GO', // Osh City
           'J', // Jalal-Abad
           'N', // Naryn
           'O', // Osh
           'T', // Talas
           'Y', // Ysyk-Kol
       ];
    }
}
