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
 * Validator for Antigua and Barbuda subdivision code.
 *
 * ISO 3166-1 alpha-2: AG
 *
 * @see http://www.geonames.org/AG/administrative-division-antigua-and-barbuda.html
 */
class AgSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '03', // Saint George
        '04', // Saint John
        '05', // Saint Mary
        '06', // Saint Paul
        '07', // Saint Peter
        '08', // Saint Philip
        '10', // Barbuda
        '11', // Redonda
    ];

    public $compareIdentical = true;
}
