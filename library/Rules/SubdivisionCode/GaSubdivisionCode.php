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
 * Validates whether an input is subdivision code of Gabon or not.
 *
 * ISO 3166-1 alpha-2: GA
 *
 * @see http://www.geonames.org/GA/administrative-division-gabon.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class GaSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '1', // Estuaire
           '2', // Haut-Ogooue
           '3', // Moyen-Ogooue
           '4', // Ngounie
           '5', // Nyanga
           '6', // Ogooue-Ivindo
           '7', // Ogooue-Lolo
           '8', // Ogooue-Maritime
           '9', // Woleu-Ntem
       ];
    }
}
