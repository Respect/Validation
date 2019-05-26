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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class BdSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Bandarban
        '02', // Barguna
        '03', // Bogra
        '04', // Brahmanbaria
        '05', // Bagerhat
        '06', // Barisal
        '07', // Bhola
        '08', // Comilla
        '09', // Chandpur
        '10', // Chittagong
        '11', // Cox's Bazar
        '12', // Chuadanga
        '13', // Dhaka
        '14', // Dinajpur
        '15', // Faridpur
        '16', // Feni
        '17', // Gopalganj
        '18', // Gazipur
        '19', // Gaibandha
        '20', // Habiganj
        '21', // Jamalpur
        '22', // Jessore
        '23', // Jhenaidah
        '24', // Jaipurhat
        '25', // Jhalakati
        '26', // Kishorganj
        '27', // Khulna
        '28', // Kurigram
        '29', // Khagrachari
        '30', // Kushtia
        '31', // Lakshmipur
        '32', // Lalmonirhat
        '33', // Manikganj
        '34', // Mymensingh
        '35', // Munshiganj
        '36', // Madaripur
        '37', // Magura
        '38', // Moulvibazar
        '39', // Meherpur
        '40', // Narayanganj
        '41', // Netrakona
        '42', // Narsingdi
        '43', // Narail
        '44', // Natore
        '45', // Nawabganj
        '46', // Nilphamari
        '47', // Noakhali
        '48', // Naogaon
        '49', // Pabna
        '50', // Pirojpur
        '51', // Patuakhali
        '52', // Panchagarh
        '53', // Rajbari
        '54', // Rajshahi
        '55', // Rangpur
        '56', // Rangamati
        '57', // Sherpur
        '58', // Satkhira
        '59', // Sirajganj
        '60', // Sylhet
        '61', // Sunamganj
        '62', // Shariatpur
        '63', // Tangail
        '64', // Thakurgaon
        'A', // Barisal
        'B', // Chittagong
        'C', // Dhaka
        'D', // Khulna
        'E', // Rajshahi
        'F', // Rangpur
        'G', // Sylhet
    ];

    public $compareIdentical = true;
}
