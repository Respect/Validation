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
 * Validates whether an input is subdivision code of Iceland or not.
 *
 * ISO 3166-1 alpha-2: IS
 *
 * @see http://www.geonames.org/IS/administrative-division-iceland.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IsSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '1', // Höfuðborgarsvæði
           '2', // Suðurnes
           '3', // Vesturland
           '4', // Vestfirðir
           '5', // Norðurland Vestra
           '6', // Norðurland Eystra
           '7', // Austurland
           '8', // Suðurland
       ];
    }
}
