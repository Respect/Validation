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
 * Validates whether an input is subdivision code of Switzerland or not.
 *
 * ISO 3166-1 alpha-2: CH
 *
 * @see http://www.geonames.org/CH/administrative-division-switzerland.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ChSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AG', // Aargau
           'AI', // Appenzell Innerhoden
           'AR', // Appenzell Ausserrhoden
           'BE', // Bern
           'BL', // Basel-Landschaft
           'BS', // Basel-Stadt
           'FR', // Fribourg
           'GE', // Geneva
           'GL', // Glarus
           'GR', // Graubunden
           'JU', // Jura
           'LU', // Lucerne
           'NE', // Neuchâtel
           'NW', // Nidwalden
           'OW', // Obwalden
           'SG', // St. Gallen
           'SH', // Schaffhausen
           'SO', // Solothurn
           'SZ', // Schwyz
           'TG', // Thurgau
           'TI', // Ticino
           'UR', // Uri
           'VD', // Vaud
           'VS', // Valais
           'ZG', // Zug
           'ZH', // Zurich
       ];
    }
}
