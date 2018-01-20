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
 * Validates whether an input is subdivision code of Laos or not.
 *
 * ISO 3166-1 alpha-2: LA
 *
 * @see http://www.geonames.org/LA/administrative-division-laos.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LaSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AT', // Attapu
           'BK', // Bokeo
           'BL', // Bolikhamxai
           'CH', // Champasak
           'HO', // Houaphan
           'KH', // Khammouan
           'LM', // Louang Namtha
           'LP', // Louangphabang
           'OU', // Oudomxai
           'PH', // Phongsali
           'SL', // Salavan
           'SV', // Savannakhet
           'VI', // Vientiane
           'VT', // Vientiane
           'XA', // Xaignabouli
           'XE', // Xekong
           'XI', // Xiangkhoang
           'XS', // Xaisômboun
       ];
    }
}
