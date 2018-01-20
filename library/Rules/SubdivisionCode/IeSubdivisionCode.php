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
 * Validates whether an input is subdivision code of Ireland or not.
 *
 * ISO 3166-1 alpha-2: IE
 *
 * @see http://www.geonames.org/IE/administrative-division-ireland.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IeSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'C', // Connaught
           'CE', // Clare
           'CN', // Cavan
           'CO', // Cork
           'CW', // Carlow
           'DL', // Donegal
           'G', // Galway
           'KE', // Kildare
           'KK', // Kilkenny
           'KY', // Kerry
           'L', // Leinster
           'LD', // Longford
           'LH', // Louth
           'LK', // Limerick, City and County
           'LM', // Leitrim
           'LS', // Laois
           'M', // Munster
           'MH', // Meath
           'MN', // Monaghan
           'MO', // Mayo
           'OY', // Offaly
           'RN', // Roscommon
           'SO', // Sligo
           'TA', // Tipperary
           'U', // Ulster
           'WD', // Waterford, City and County
           'WH', // Westmeath
           'WW', // Wicklow
           'WX', // Wexford
       ];
    }
}
