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
 * Validates whether an input is subdivision code of Fiji or not.
 *
 * ISO 3166-1 alpha-2: FJ
 *
 * @see http://www.geonames.org/FJ/administrative-division-fiji.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FjSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Ba Province
           '02', // Bua Province
           '03', // Cakaudrove Province
           '04', // Kadavu Province
           '05', // Lau Province
           '06', // Lomaiviti Province
           '07', // Mathuata Province
           '08', // Nandronga and Navosa Province
           '09', // Naitasiri Province
           '10', // Namosi Province
           '11', // Ra Province
           '12', // Rewa Province
           '13', // Serua Province
           '14', // Tailevu Province
           'C', // Central Division
           'E', // Eastern Division
           'N', // Northern Division
           'R', // Rotuma
           'W', // Western Division
       ];
    }
}
