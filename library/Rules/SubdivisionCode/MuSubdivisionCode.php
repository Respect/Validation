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
 * Validates whether an input is subdivision code of Mauritius or not.
 *
 * ISO 3166-1 alpha-2: MU
 *
 * @see http://www.geonames.org/MU/administrative-division-mauritius.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MuSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AG', // Agalega Islands
           'BL', // Black River
           'BR', // Beau Bassin-Rose Hill
           'CC', // Cargados Carajos Shoals (Saint Brandon Islands)
           'CU', // Curepipe
           'FL', // Flacq
           'GP', // Grand Port
           'MO', // Moka
           'PA', // Pamplemousses
           'PL', // Port Louis
           'PU', // Port Louis
           'PW', // Plaines Wilhems
           'QB', // Quatre Bornes
           'RO', // Rodrigues
           'RR', // Riviere du Rempart
           'SA', // Savanne
           'VP', // Vacoas-Phoenix
       ];
    }
}
