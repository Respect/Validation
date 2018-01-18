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
 * Validates whether an input is subdivision code of Samoa or not.
 *
 * ISO 3166-1 alpha-2: WS
 *
 * @see http://www.geonames.org/WS/administrative-division-samoa.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class WsSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AA', // A'ana
           'AL', // Aiga-i-le-Tai
           'AT', // Atua
           'FA', // Fa'asaleleaga
           'GE', // Gaga'emauga
           'GI', // Gagaifomauga
           'PA', // Palauli
           'SA', // Satupa'itea
           'TU', // Tuamasaga
           'VF', // Va'a-o-Fonoti
           'VS', // Vaisigano
       ];
    }
}
