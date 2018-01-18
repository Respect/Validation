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
 * Validates whether an input is subdivision code of Georgia or not.
 *
 * ISO 3166-1 alpha-2: GE
 *
 * @see http://www.geonames.org/GE/administrative-division-georgia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class GeSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AB', // Abkhazia
           'AJ', // Ajaria
           'GU', // Guria
           'IM', // Imereti
           'KA', // Kakheti
           'KK', // Kvemo Kartli
           'MM', // Mtskheta-Mtianeti
           'RL', // Racha Lechkhumi and Kvemo Svaneti
           'SJ', // Samtskhe-Javakheti
           'SK', // Shida Kartli
           'SZ', // Samegrelo-Zemo Svaneti
           'TB', // Tbilisi
       ];
    }
}
