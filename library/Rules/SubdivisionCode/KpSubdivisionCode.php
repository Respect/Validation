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
 * Validates whether an input is subdivision code of North Korea or not.
 *
 * ISO 3166-1 alpha-2: KP
 *
 * @see http://www.geonames.org/KP/administrative-division-north-korea.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KpSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // P'yongyang Special City
           '02', // P'yongan-namdo
           '03', // P'yongan-bukto
           '04', // Chagang-do
           '05', // Hwanghae-namdo
           '06', // Hwanghae-bukto
           '07', // Kangwon-do
           '08', // Hamgyong-namdo
           '09', // Hamgyong-bukto
           '10', // Ryanggang-do (Yanggang-do)
           '13', // Nasŏn (Najin-Sŏnbong)
       ];
    }
}
