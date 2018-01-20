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
 * Validates whether an input is subdivision code of Suriname or not.
 *
 * ISO 3166-1 alpha-2: SR
 *
 * @see http://www.geonames.org/SR/administrative-division-suriname.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SrSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BR', // Brokopondo
           'CM', // Commewijne
           'CR', // Coronie
           'MA', // Marowijne
           'NI', // Nickerie
           'PM', // Paramaribo
           'PR', // Para
           'SA', // Saramacca
           'SI', // Sipaliwini
           'WA', // Wanica
       ];
    }
}
