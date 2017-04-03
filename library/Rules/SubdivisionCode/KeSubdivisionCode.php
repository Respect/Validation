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
 * Validator for Kenya subdivision code.
 *
 * ISO 3166-1 alpha-2: KE
 *
 * @link http://www.geonames.org/KE/administrative-division-kenya.html
 */
class KeSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Baringo
        '02', // Bomet
        '03', // Bungoma
        '04', // Busia
        '05', // Elgeyo/Marakwet
        '06', // Embu
        '07', // Garissa
        '08', // Homa Bay
        '09', // Isiolo
        '10', // Kajiado
        '11', // Kakamega
        '12', // Kericho
        '13', // Kiambu
        '14', // Kilifi
        '15', // Kirinyaga
        '16', // Kisii
        '17', // Kisumu
        '18', // Kitui
        '19', // Kwale
        '20', // Laikipia
        '21', // Lamu
        '22', // Machakos
        '23', // Makueni
        '24', // Mandera
        '25', // Marsabit
        '26', // Meru
        '27', // Migori
        '28', // Mombasa
        '29', // Murang’a
        '30', // Nairobi
        '31', // Nakuru
        '32', // Nandi
        '33', // Narok
        '34', // Nyamira
        '35', // Nyandarua
        '36', // Nyeri
        '37', // Samburu
        '38', // Siaya
        '39', // Taita/Taveta
        '40', // Tana River
        '41', // Tharak-Nithi
        '42', // Trans Nzoia
        '43', // Turkana
        '44', // Uasin Gishu
        '45', // Vihiga
        '46', // Wajir
        '47', // West Pokot
    ];

    public $compareIdentical = true;
}
