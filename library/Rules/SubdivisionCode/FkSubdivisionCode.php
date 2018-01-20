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
 * Validates whether an input is subdivision code of Falkland Islands or not.
 *
 * ISO 3166-1 alpha-2: FK
 *
 * @see http://www.geonames.org/FK/administrative-division-falkland-islands.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FkSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [];
    }
}
