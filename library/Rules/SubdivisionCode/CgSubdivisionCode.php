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
 * Validates whether an input is subdivision code of Republic of the Congo or not.
 *
 * ISO 3166-1 alpha-2: CG
 *
 * @see http://www.geonames.org/CG/administrative-division-republic-of-the-congo.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CgSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '11', // Bouenza
           '12', // Pool
           '13', // Sangha
           '14', // Plateaux
           '15', // Cuvette-Ouest
           '16', // Pointe-Noire
           '2', // Lekoumou
           '5', // Kouilou
           '7', // Likouala
           '8', // Cuvette
           '9', // Niari
           'BZV', // Brazzaville
       ];
    }
}
