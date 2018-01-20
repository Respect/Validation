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
 * Validates whether an input is subdivision code of India or not.
 *
 * ISO 3166-1 alpha-2: IN
 *
 * @see http://www.geonames.org/IN/administrative-division-india.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class InSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AN', // Andaman and Nicobar Islands
           'AP', // Andhra Pradesh
           'AR', // Arunachal Pradesh
           'AS', // Assam
           'BR', // Bihar
           'CH', // Chandigarh
           'CT', // Chhattisgarh
           'DD', // Daman and Diu
           'DL', // Delhi
           'DN', // Dadra and Nagar Haveli
           'GA', // Goa
           'GJ', // Gujarat
           'HP', // Himachal Pradesh
           'HR', // Haryana
           'JH', // Jharkhand
           'JK', // Jammu and Kashmir
           'KA', // Karnataka
           'KL', // Kerala
           'LD', // Lakshadweep
           'MH', // Maharashtra
           'ML', // Meghalaya
           'MN', // Manipur
           'MP', // Madhya Pradesh
           'MZ', // Mizoram
           'NL', // Nagaland
           'OR', // Orissa
           'PB', // Punjab
           'PY', // Pondicherry
           'RJ', // Rajasthan
           'SK', // Sikkim
           'TG', // Telangana
           'TN', // Tamil Nadu
           'TR', // Tripura
           'UP', // Uttar Pradesh
           'UT', // Uttarakhand
           'WB', // West Bengal
       ];
    }
}
