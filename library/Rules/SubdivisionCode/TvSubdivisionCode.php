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
 * Validates whether an input is subdivision code of Tuvalu or not.
 *
 * ISO 3166-1 alpha-2: TV
 *
 * @see http://www.geonames.org/TV/administrative-division-tuvalu.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class TvSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'FUN', // Funafuti
           'NIT', // Niutao
           'NKF', // Nukufetau
           'NKL', // Nukulaelae
           'NMA', // Nanumea
           'NMG', // Nanumanga
           'NUI', // Nui
           'VAI', // Vaitupu
       ];
    }
}
