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
 * Validates whether an input is subdivision code of Guyana or not.
 *
 * ISO 3166-1 alpha-2: GY
 *
 * @see http://www.geonames.org/GY/administrative-division-guyana.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class GySubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BA', // Barima-Waini
           'CU', // Cuyuni-Mazaruni
           'DE', // Demerara-Mahaica
           'EB', // East Berbice-Corentyne
           'ES', // Essequibo Islands-West Demerara
           'MA', // Mahaica-Berbice
           'PM', // Pomeroon-Supenaam
           'PT', // Potaro-Siparuni
           'UD', // Upper Demerara-Berbice
           'UT', // Upper Takutu-Upper Essequibo
       ];
    }
}
