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
 * Validates whether an input is subdivision code of Antigua and Barbuda or not.
 *
 * ISO 3166-1 alpha-2: AG
 *
 * @see http://www.geonames.org/AG/administrative-division-antigua-and-barbuda.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AgSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '03', // Saint George
           '04', // Saint John
           '05', // Saint Mary
           '06', // Saint Paul
           '07', // Saint Peter
           '08', // Saint Philip
           '10', // Barbuda
           '11', // Redonda
       ];
    }
}
