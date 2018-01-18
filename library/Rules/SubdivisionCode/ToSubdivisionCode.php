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
 * Validates whether an input is subdivision code of Tonga or not.
 *
 * ISO 3166-1 alpha-2: TO
 *
 * @see http://www.geonames.org/TO/administrative-division-tonga.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ToSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Eua
           '02', // Ha'apai
           '03', // Niuas
           '04', // Tongatapu
           '05', // Vava'u
       ];
    }
}
