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
 * Validates whether an input is subdivision code of Equatorial Guinea or not.
 *
 * ISO 3166-1 alpha-2: GQ
 *
 * @see http://www.geonames.org/GQ/administrative-division-equatorial-guinea.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class GqSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AN', // Provincia Annobon
           'BN', // Provincia Bioko Norte
           'BS', // Provincia Bioko Sur
           'C', // Región Continental
           'CS', // Provincia Centro Sur
           'I', // Región Insular
           'KN', // Provincia Kie-Ntem
           'LI', // Provincia Litoral
           'WN', // Provincia Wele-Nzas
       ];
    }
}
