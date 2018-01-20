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
 * Validates whether an input is subdivision code of San Marino or not.
 *
 * ISO 3166-1 alpha-2: SM
 *
 * @see http://www.geonames.org/SM/administrative-division-san-marino.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SmSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Acquaviva
           '02', // Chiesanuova
           '03', // Domagnano
           '04', // Faetano
           '05', // Fiorentino
           '06', // Borgo Maggiore
           '07', // Citta di San Marino
           '08', // Montegiardino
           '09', // Serravalle
       ];
    }
}
