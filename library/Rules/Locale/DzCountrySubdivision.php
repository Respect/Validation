<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Algeria country subdivision.
 *
 * ISO 3166-1 alpha-2: DZ
 *
 * @link http://www.geonames.org/DZ/administrative-division-algeria.html
 */
class DzCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
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
    );

    public $compareIdentical = true;
}
