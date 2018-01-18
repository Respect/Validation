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
 * Validates whether an input is subdivision code of Jordan or not.
 *
 * ISO 3166-1 alpha-2: JO
 *
 * @see http://www.geonames.org/JO/administrative-division-jordan.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class JoSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AJ', // Ajlun
           'AM', // 'Amman
           'AQ', // Al 'Aqabah
           'AT', // At Tafilah
           'AZ', // Az Zarqa'
           'BA', // Al Balqa'
           'IR', // Irbid
           'JA', // Jarash
           'KA', // Al Karak
           'MA', // Al Mafraq
           'MD', // Madaba
           'MN', // Ma'an
       ];
    }
}
