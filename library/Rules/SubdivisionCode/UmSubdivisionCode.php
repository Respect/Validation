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
 * Validates whether an input is subdivision code of U.S. Minor Outlying Islands or not.
 *
 * ISO 3166-1 alpha-2: UM
 *
 * @see http://www.geonames.org/UM/administrative-division-united-states-minor-outlying-islands.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class UmSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '67', // Johnston Atoll
           '71', // Midway Atoll
           '76', // Navassa Island
           '79', // Wake Island
           '81', // Baker Island
           '84', // Howland Island
           '86', // Jarvis Island
           '89', // Kingman Reef
           '95', // Palmyra Atoll
       ];
    }
}
