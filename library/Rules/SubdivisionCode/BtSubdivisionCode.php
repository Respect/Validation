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
 * Validates whether an input is subdivision code of Bhutan or not.
 *
 * ISO 3166-1 alpha-2: BT
 *
 * @see http://www.geonames.org/BT/administrative-division-bhutan.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BtSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '11', // Paro
           '12', // Chukha
           '13', // Haa
           '14', // Samtse
           '15', // Thimphu
           '21', // Tsirang
           '22', // Dagana
           '23', // Punakha
           '24', // Wangdue Phodrang
           '31', // Sarpang
           '32', // Trongsa
           '33', // Bumthang
           '34', // Zhemgang
           '41', // Trashigang
           '42', // Mongar
           '43', // Pemagatshel
           '44', // Lhuntse
           '45', // Samdrup Jongkhar
           'GA', // Gasa
           'TY', // Trashi Yangste
       ];
    }
}
