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
 * Validates whether an input is subdivision code of Maldives or not.
 *
 * ISO 3166-1 alpha-2: MV
 *
 * @see http://www.geonames.org/MV/administrative-division-maldives.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MvSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '00', // Alifu Dhaalu / Ari Atholhu Dhekunuburi
           '01', // Seenu / Addu Atholhu
           '02', // Alifu Alifu / Ari Atholhu Uthuruburi
           '03', // Lhaviyani / Faadhippolhu
           '04', // Vaavu / Felidhu Atholhu
           '05', // Laamu / Haddhdhunmathi
           '07', // Haa Alifu / Thiladhunmathee Uthuruburi
           '08', // Thaa / Kolhumadulu
           '12', // Meemu / Mulakatholhu
           '13', // Raa / Maalhosmadulu Uthuruburi
           '14', // Faafu / Nilandhe Atholhu Uthuruburi
           '17', // Dhaalu / Nilandhe Atholhu Dhekunuburi
           '20', // Baa / Maalhosmadulu Dhekunuburi
           '23', // Haa Dhaalu / Thiladhunmathee Dhekunuburi
           '24', // Shaviyani / Miladhunmadulu Uthuruburi
           '25', // Noonu / Miladhunmadulu Dhekunuburi
           '26', // Kaafu / Maale Atholhu
           '27', // Gaafu Alifu / Huvadhu Atholhu Uthuruburi
           '28', // Gaafu Dhaalu / Huvadhu Atholhu Dhekunuburi
           '29', // Gnaviyani / Fuvammulah
       ];
    }
}
