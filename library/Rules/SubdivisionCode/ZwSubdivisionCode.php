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
 * Validates whether an input is subdivision code of Zimbabwe or not.
 *
 * ISO 3166-1 alpha-2: ZW
 *
 * @see http://www.geonames.org/ZW/administrative-division-zimbabwe.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ZwSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BU', // Bulawayo (city)
           'HA', // Harare (city)
           'MA', // Manicaland
           'MC', // Mashonaland Central
           'ME', // Mashonaland East
           'MI', // Midlands
           'MN', // Matabeleland North
           'MS', // Matabeleland South
           'MV', // Masvingo
           'MW', // Mashonaland West
       ];
    }
}
