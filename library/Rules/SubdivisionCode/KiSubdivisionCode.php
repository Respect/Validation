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
 * Validates whether an input is subdivision code of Kiribati or not.
 *
 * ISO 3166-1 alpha-2: KI
 *
 * @see http://www.geonames.org/KI/administrative-division-kiribati.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class KiSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'G', // Gilbert Islands
           'L', // Line Islands
           'P', // Phoenix Islands
       ];
    }
}
