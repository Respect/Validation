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
 * Validates whether an input is subdivision code of Bolivia or not.
 *
 * ISO 3166-1 alpha-2: BO
 *
 * @see http://www.geonames.org/BO/administrative-division-bolivia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BoSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'B', // Departmento Beni
           'C', // Departmento Cochabamba
           'H', // Departmento Chuquisaca
           'L', // Departmento La Paz
           'N', // Departmento Pando
           'O', // Departmento Oruro
           'P', // Departmento Potosi
           'S', // Departmento Santa Cruz
           'T', // Departmento Tarija
       ];
    }
}
