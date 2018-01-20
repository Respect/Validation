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
 * Validates whether an input is subdivision code of Taiwan or not.
 *
 * ISO 3166-1 alpha-2: TW
 *
 * @see http://www.geonames.org/TW/administrative-division-taiwan.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class TwSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'CHA', // Changhua
           'CYI', // Chiayi
           'CYQ', // Chiayi
           'HSQ', // Hsinchu
           'HSZ', // Hsinchu
           'HUA', // Hualien
           'ILA', // Ilan
           'KEE', // Keelung
           'KHH', // Kaohsiung
           'KIN', // Kinmen
           'LIE', // Lienchiang
           'MIA', // Miaoli
           'NAN', // Nantou
           'NWT', // New Taipei
           'PEN', // Penghu
           'PIF', // Pingtung
           'TAO', // Taoyuan
           'TNN', // Tainan
           'TPE', // Taipei
           'TTT', // Taitung
           'TXG', // Taichung
           'YUN', // Yunlin
       ];
    }
}
