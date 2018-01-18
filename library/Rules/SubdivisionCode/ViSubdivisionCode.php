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
 * Validates whether an input is subdivision code of U.S. Virgin Islands or not.
 *
 * ISO 3166-1 alpha-2: VI
 *
 * @see http://www.geonames.org/VI/administrative-division-u-s-virgin-islands.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ViSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'C', // Saint Croix
           'J', // Saint John
           'T', // Saint Thomas
       ];
    }
}
