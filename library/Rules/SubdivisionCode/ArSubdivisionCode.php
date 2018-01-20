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
 * Validates whether an input is subdivision code of Argentina or not.
 *
 * ISO 3166-1 alpha-2: AR
 *
 * @see http://www.geonames.org/AR/administrative-division-argentina.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ArSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'A', // Salta
           'B', // Buenos Aires Province
           'C', // Ciudad Autónoma de Buenos Aires
           'D', // San Luis
           'E', // Entre Rios
           'F', // La Rioja
           'G', // Santiago del Estero
           'H', // Chaco
           'J', // San Juan
           'K', // Catamarca
           'L', // La Pampa
           'M', // Mendoza
           'N', // Misiones
           'P', // Formosa
           'Q', // Neuquen
           'R', // Rio Negro
           'S', // Santa Fe
           'T', // Tucuman
           'U', // Chubut
           'V', // Tierra del Fuego
           'W', // Corrientes
           'X', // Cordoba
           'Y', // Jujuy
           'Z', // Santa Cruz
       ];
    }
}
