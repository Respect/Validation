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
 * Validator for Algeria subdivision code.
 *
 * ISO 3166-1 alpha-2: DZ
 *
 * @link http://www.geonames.org/DZ/administrative-division-algeria.html
 */
class DzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Adrar
        '02', // Chlef
        '03', // Laghouat
        '04', // Oum el-Bouaghi
        '05', // Batna
        '06', // Bejaia
        '07', // Biskra
        '08', // Bechar
        '09', // Blida
        '10', // Bouira
        '11', // Tamanghasset
        '12', // Tebessa
        '13', // Tlemcen
        '14', // Tiaret
        '15', // Tizi Ouzou
        '16', // Alger
        '17', // Djelfa
        '18', // Jijel
        '19', // Setif
        '20', // Saida
        '21', // Skikda
        '22', // Sidi Bel Abbes
        '23', // Annaba
        '24', // Guelma
        '25', // Constantine
        '26', // Medea
        '27', // Mostaganem
        '28', // M'Sila
        '29', // Muaskar
        '30', // Ouargla
        '31', // Oran
        '32', // El Bayadh
        '33', // Illizi
        '34', // Bordj Bou Arreridj
        '35', // Boumerdes
        '36', // El Tarf
        '37', // Tindouf
        '38', // Tissemsilt
        '39', // El Oued
        '40', // Khenchela
        '41', // Souk Ahras
        '42', // Tipaza
        '43', // Mila
        '44', // Ain Defla
        '45', // Naama
        '46', // Ain Temouchent
        '47', // Ghardaia
        '48', // Relizane
    ];

    public $compareIdentical = true;
}
