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
 * Validates whether an input is subdivision code of Mongolia or not.
 *
 * ISO 3166-1 alpha-2: MN
 *
 * @see http://www.geonames.org/MN/administrative-division-mongolia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MnSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '035', // Orhon
           '037', // Darhan uul
           '039', // Hentiy
           '041', // Hovsgol
           '043', // Hovd
           '046', // Uvs
           '047', // Tov
           '049', // Selenge
           '051', // Suhbaatar
           '053', // Omnogovi
           '055', // Ovorhangay
           '057', // Dzavhan
           '059', // DundgovL
           '061', // Dornod
           '063', // Dornogov
           '064', // Govi-Sumber
           '065', // Govi-Altay
           '067', // Bulgan
           '069', // Bayanhongor
           '071', // Bayan-Olgiy
           '073', // Arhangay
           '1', // Ulanbaatar
       ];
    }
}
