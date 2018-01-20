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
 * Validates whether an input is subdivision code of East Timor or not.
 *
 * ISO 3166-1 alpha-2: TL
 *
 * @see http://www.geonames.org/TL/administrative-division-east-timor.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class TlSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AL', // Aileu
           'AN', // Ainaro
           'BA', // Baucau
           'BO', // Bobonaro
           'CO', // Cova Lima
           'DI', // Dili
           'ER', // Ermera
           'LA', // Lautem
           'LI', // Liquica
           'MF', // Manufahi
           'MT', // Manatuto
           'OE', // Oecussi
           'VI', // Viqueque
       ];
    }
}
