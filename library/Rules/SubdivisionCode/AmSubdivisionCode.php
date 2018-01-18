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
 * Validates whether an input is subdivision code of Armenia or not.
 *
 * ISO 3166-1 alpha-2: AM
 *
 * @see http://www.geonames.org/AM/administrative-division-armenia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AmSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AG', // Aragatsotn
           'AR', // Ararat
           'AV', // Armavir
           'ER', // Yerevan
           'GR', // Geghark'unik'
           'KT', // Kotayk'
           'LO', // Lorri
           'SH', // Shirak
           'SU', // Syunik'
           'TV', // Tavush
           'VD', // Vayots' Dzor
       ];
    }
}
