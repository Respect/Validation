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
 * Validates whether an input is subdivision code of Eritrea or not.
 *
 * ISO 3166-1 alpha-2: ER
 *
 * @see http://www.geonames.org/ER/administrative-division-eritrea.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ErSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AN', // Anseba (Keren)
           'DK', // Southern Red Sea (Debub-Keih-Bahri)
           'DU', // Southern (Debub)
           'GB', // Gash-Barka (Barentu)
           'MA', // Central (Maekel)
           'SK', // Northern Red Sea (Semien-Keih-Bahri)
       ];
    }
}
