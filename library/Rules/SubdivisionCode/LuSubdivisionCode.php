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
 * Validates whether an input is subdivision code of Luxembourg or not.
 *
 * ISO 3166-1 alpha-2: LU
 *
 * @see http://www.geonames.org/LU/administrative-division-luxembourg.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LuSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'CA', // Canton de Capellen
           'CL', // Canton de Clervaux
           'DI', // Canton de Diekirch
           'EC', // Canton d'Echternach
           'ES', // Canton d'Esch-sur-Alzette
           'GR', // Canton de Grevenmacher
           'LU', // Canton de Luxembourg
           'ME', // Canton de Mersch
           'RD', // Canton de Redange
           'RM', // Canton de Remich
           'VD', // Canton de Vianden
           'WI', // Canton de Wiltz
       ];
    }
}
