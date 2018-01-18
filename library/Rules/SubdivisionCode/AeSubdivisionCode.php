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
 * Validates whether an input is subdivision code of United Arab Emirates or not.
 *
 * ISO 3166-1 alpha-2: AE
 *
 * @see http://www.geonames.org/AE/administrative-division-united-arab-emirates.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AeSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AJ', // 'Ajman
           'AZ', // Abu Zaby
           'DU', // Dubayy
           'FU', // Al Fujayrah
           'RK', // R'as al Khaymah
           'SH', // Ash Shariqah
           'UQ', // Umm al Qaywayn
       ];
    }
}
