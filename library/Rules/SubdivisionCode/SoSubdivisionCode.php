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
 * Validates whether an input is subdivision code of Somalia or not.
 *
 * ISO 3166-1 alpha-2: SO
 *
 * @see http://www.geonames.org/SO/administrative-division-somalia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SoSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AW', // Awdal
           'BK', // Bakool
           'BN', // Banaadir
           'BR', // Bari
           'BY', // Bay
           'GA', // Galguduud
           'GE', // Gedo
           'HI', // Hiiraan
           'JD', // Jubbada Dhexe
           'JH', // Jubbada Hoose
           'MU', // Mudug
           'NU', // Nugaal
           'SA', // Sanaag
           'SD', // Shabeellaha Dhexe
           'SH', // Shabeellaha Hoose
           'SO', // Sool
           'TO', // Togdheer
           'WO', // Woqooyi Galbeed
       ];
    }
}
