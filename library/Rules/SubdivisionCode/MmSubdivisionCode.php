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
 * Validates whether an input is subdivision code of Myanmar [Burma] or not.
 *
 * ISO 3166-1 alpha-2: MM
 *
 * @see http://www.geonames.org/MM/administrative-division-myanmar.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MmSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Sagaing
           '02', // Bago
           '03', // Magway
           '04', // Mandalay
           '05', // Tanintharyi
           '06', // Yangon
           '07', // Ayeyarwady
           '11', // Kachin State
           '12', // Kayah State
           '13', // Kayin State
           '14', // Chin State
           '15', // Mon State
           '16', // Rakhine State
           '17', // Shan State
           '18', // Nay Pyi Taw
       ];
    }
}
