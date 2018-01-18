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
 * Validates whether an input is subdivision code of Venezuela or not.
 *
 * ISO 3166-1 alpha-2: VE
 *
 * @see http://www.geonames.org/VE/administrative-division-venezuela.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class VeSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'A', // Federal Capital
           'B', // Anzoategui
           'C', // Apure
           'D', // Aragua
           'E', // Barinas
           'F', // Bolivar
           'G', // Carabobo
           'H', // Cojedes
           'I', // Falcon
           'J', // Guarico
           'K', // Lara
           'L', // Merida
           'M', // Miranda
           'N', // Monagas
           'O', // Nueva Esparta
           'P', // Portuguesa
           'R', // Sucre
           'S', // Tachira
           'T', // Trujillo
           'U', // Yaracuy
           'V', // Zulia
           'W', // Federal Dependency
           'X', // Vargas
           'Y', // Delta Amacuro
           'Z', // Amazonas
       ];
    }
}
