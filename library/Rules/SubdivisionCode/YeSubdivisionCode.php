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
 * Validates whether an input is subdivision code of Yemen or not.
 *
 * ISO 3166-1 alpha-2: YE
 *
 * @see http://www.geonames.org/YE/administrative-division-yemen.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class YeSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AB', // Abyan
           'AD', // Adan
           'AM', // Amran
           'BA', // Al Bayda
           'DA', // Ad Dali
           'DH', // Dhamar
           'HD', // Hadramawt
           'HJ', // Hajjah
           'HU', // Al Hudaydah
           'IB', // Ibb
           'JA', // Al Jawf
           'LA', // Lahij
           'MA', // Ma'rib
           'MR', // Al Mahrah
           'MW', // Al Mahwit
           'RA', // Raymah
           'SA', // Amanat Al Asimah
           'SD', // Sa'dah
           'SH', // Shabwah
           'SN', // San'a
           'SU', // Socotra
           'TA', // Ta'izz
       ];
    }
}
