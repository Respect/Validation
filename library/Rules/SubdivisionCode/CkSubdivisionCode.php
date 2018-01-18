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
 * Validates whether an input is subdivision code of Cook Islands or not.
 *
 * ISO 3166-1 alpha-2: CK
 *
 * @see http://www.geonames.org/CK/administrative-division-cook-islands.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CkSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AI', // Aitutaki
           'AT', // Atiu
           'MA', // Manuae
           'MG', // Mangaia
           'MK', // Manihiki
           'MT', // Mitiaro
           'MU', // Mauke
           'NI', // Nassau Island
           'PA', // Palmerston
           'PE', // Penrhyn
           'PU', // Pukapuka
           'RK', // Rakahanga
           'RR', // Rarotonga
           'SU', // Surwarrow
           'TA', // Takutea
       ];
    }
}
