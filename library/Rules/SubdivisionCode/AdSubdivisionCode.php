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
 * Validates whether an input is subdivision code of Andorra or not.
 *
 * ISO 3166-1 alpha-2: AD
 *
 * @see http://www.geonames.org/AD/administrative-division-andorra.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AdSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '02', // Canillo
           '03', // Encamp
           '04', // La Massana
           '05', // Ordino
           '06', // Sant Julia de Lòria
           '07', // Andorra la Vella
           '08', // Escaldes-Engordany
       ];
    }
}
