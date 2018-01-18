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
 * Validates whether an input is subdivision code of Finland or not.
 *
 * ISO 3166-1 alpha-2: FI
 *
 * @see http://www.geonames.org/FI/administrative-division-finland.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FiSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Ahvenanmaa [Finnish] / Åland [Swedish]
           '02', // Etelä-Karjala [Finnish] / Södra Karelen [Swedish]
           '03', // Etelä-Pohjanmaa [Finnish] / Södra Österbotten [Swedish]
           '04', // Etelä-Savo [Finnish] / Södra Savolax [Swedish]
           '05', // Kainuu [Finnish] / Kajanaland [Swedish]
           '06', // Kanta-Häme [Finnish] / Egentliga Tavastland [Swedish]
           '07', // Keski-Pohjanmaa [Finnish] / Mellersta Österbotten [Swedish]
           '08', // Keski-Suomi [Finnish] / Mellersta Finland [Swedish]
           '09', // Kymenlaakso [Finnish] / Kymmenedalen [Swedish]
           '10', // Lappi [Finnish] / Lappland [Swedish]
           '11', // Pirkanmaa [Finnish] / Birkaland [Swedish]
           '12', // Pohjanmaa [Finnish] / Österbotten [Swedish]
           '13', // Pohjois-Karjala [Finnish] / Norra Karelen [Swedish]
           '14', // Pohjois-Pohjanmaa [Finnish] / Norra Österbotten [Swedish]
           '15', // Pohjois-Savo [Finnish] / Norra Savolax [Swedish]
           '16', // Päijät-Häme [Finnish] / Päijänne-Tavastland [Swedish]
           '17', // Satakunta [Finnish and Swedish]
           '18', // Uusimaa [Finnish] / Nyland [Swedish]
           '19', // Varsinais-Suomi [Finnish] / Egentliga Finland [Swedish]
       ];
    }
}
