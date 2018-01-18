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
 * Validates whether an input is subdivision code of Saint Lucia or not.
 *
 * ISO 3166-1 alpha-2: LC
 *
 * @see http://www.geonames.org/LC/administrative-division-saint-lucia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LcSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Anse-la-Raye
           '02', // Castries
           '03', // Choiseul
           '05', // Dennery
           '06', // Gros-Islet
           '07', // Laborie
           '08', // Micoud
           '10', // Soufriere
           '11', // Vieux-Fort
           '12', // Canaries
       ];
    }
}
