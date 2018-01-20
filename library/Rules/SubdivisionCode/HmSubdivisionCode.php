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
 * Validates whether an input is subdivision code of Heard Island and McDonald Islands or not.
 *
 * ISO 3166-1 alpha-2: HM
 *
 * @see http://www.geonames.org/HM/administrative-division-heard-island-and-mcdonald-islands.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class HmSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'F', // Flat Island
           'H', // Heard Island
           'M', // McDonald Island
           'S', // Shag Island
       ];
    }
}
