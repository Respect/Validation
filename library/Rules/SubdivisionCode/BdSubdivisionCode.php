<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Bangladesh subdivision code.
 *
 * ISO 3166-1 alpha-2: BD
 *
 * @link http://www.geonames.org/BD/administrative-division-bangladesh.html
 */
class BdSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'A', // Barisal
        'B', // Chittagong
        'C', // Dhaka
        'D', // Khulna
        'E', // Rajshahi
        'F', // Rangpur
        'G', // Sylhet
        '01', // Bandarban zila
        '02', // Barguna zila
        '03', // Bogra zila
        '04', // Brahmanbaria zila
        '05', // Bagerhat zila
        '06', // Barisal zila
        '07', // Bhola zila
        '08', // Comilla zila
        '09', // Chandpur zila
        '10', // Chittagong zila
        '11', // Cox's Bazar zila
        '12', // Chuadanga zila
        '13', // Dhaka zila
        '14', // Dinajpur zila
        '15', // Faridpur zila
        '16', // Feni zila
        '17', // Gopalganj zila
        '18', // Gazipur zila
        '19', // Gaibandha zila
        '20', // Habiganj zila
        '21', // Jamalpur zila
        '22', // Jessore zila
        '23', // Jhenaidah zila
        '24', // Jaipurhat zila
        '25', // Jhalakati zila
        '26', // Kishoreganj zila
        '27', // Khulna zila
        '28', // Kurigram zila
        '29', // Khagrachari zila
        '30', // Kushtia zila
        '31', // Lakshmipur zila
        '32', // Lalmonirhat zila
        '33', // Manikganj zila
        '34', // Mymensingh zila
        '35', // Munshiganj zila
        '36', // Madaripur zila
        '37', // Magura zila
        '38', // Moulvibazar zila
        '39', // Meherpur zila
        '40', // Narayanganj zila
        '41', // Netrakona zila
        '42', // Narsingdi zila
        '43', // Narail zila
        '44', // Natore zila
        '45', // Nawabganj zila
        '46', // Nilphamari zila
        '47', // Noakhali zila
        '48', // Naogaon zila
        '49', // Pabna zila
        '50', // Pirojpur zila
        '51', // Patuakhali zila
        '52', // Panchagarh zila
        '53', // Rajbari zila
        '54', // Rajshahi zila
        '55', // Rangpur zila
        '56', // Rangamati zila
        '57', // Sherpur zila
        '58', // Satkhira zila
        '59', // Sirajganj zila
        '60', // Sylhet zila
        '61', // Sunamganj zila
        '62', // Shariatpur zila
        '63', // Tangail zila
        '64', // Thakurgaon zila
    ];

    public $compareIdentical = true;
}
