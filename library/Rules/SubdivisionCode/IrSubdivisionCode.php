<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Iran subdivision code.
 *
 * ISO 3166-1 alpha-2: IR
 *
 * @link http://www.geonames.org/IR/administrative-division-iran.html
 */
class IrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // East Azarbaijan
        '02', // West Azarbaijan
        '03', // Ardabil
        '04', // Esfahan
        '05', // Ilam
        '06', // Bushehr
        '07', // Tehran
        '08', // Chahar Mahaal and Bakhtiari
        '10', // Khuzestan
        '11', // Zanjan
        '12', // Semnan
        '13', // Sistan and Baluchistan
        '14', // Fars
        '15', // Kerman
        '16', // Kurdistan
        '17', // Kermanshah
        '18', // Kohkiluyeh and Buyer Ahmad
        '19', // Gilan
        '20', // Lorestan
        '21', // Mazandaran
        '22', // Markazi
        '23', // Hormozgan
        '24', // Hamadan
        '25', // Yazd
        '26', // Qom
        '27', // Golestan
        '28', // Qazvin
        '29', // South Khorasan
        '30', // Razavi Khorasan
        '31', // North Khorasan
        '09', // Khorāsān
    ];

    public $compareIdentical = true;
}
