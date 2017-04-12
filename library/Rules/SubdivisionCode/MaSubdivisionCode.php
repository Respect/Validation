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
 * Validator for Morocco subdivision code.
 *
 * ISO 3166-1 alpha-2: MA
 *
 * @link http://www.geonames.org/MA/administrative-division-morocco.html
 */
class MaSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Tanger-Tetouan-Al Hoceima
        '02', // Oriental
        '03', // Fès-Meknès
        '04', // Rabat-Salé-Kénitra
        '05', // Béni Mellal-Khénifra
        '06', // Casablanca-Settat
        '07', // Marrakesh-Safi
        '08', // Drâa-Tafilalet
        '09', // Souss-Massa
        '10', // Guelmim-Oued Noun
        '11', // Laâyoune-Sakia El Hamra
        '12', // Dakhla-Oued Ed-Dahab
        'AGD', // Agadir-Ida-Outanane
        'AOU', // Aousserd (EH)
        'ASZ', // Assa-Zag
        'AZI', // Azilal
        'BEM', // Beni Mellal
        'BER', // Berkane
        'BES', // Ben Slimane
        'BOD', // Boujdour (EH)
        'BOM', // Boulemane
        'CAS', // Casablanca [Dar el Beïda]
        'CHE', // Chefchaouen
        'CHI', // Chichaoua
        'CHT', // Chtouka-Ait Baha
        'ERR', // Errachidia
        'ESI', // Essaouira
        'ESM', // Es Smara (EH)
        'FAH', // Fahs-Beni Makada
        'FES', // Fès-Dar-Dbibegh
        'FIG', // Figuig
        'GUE', // Guelmim
        'HAJ', // El Hajeb
        'HAO', // Al Haouz
        'HOC', // Al Hoceïma
        'IFR', // Ifrane
        'INE', // Inezgane-Ait Melloul
        'JDI', // El Jadida
        'JRA', // Jrada
        'KEN', // Kénitra
        'KES', // Kelaat es Sraghna
        'KHE', // Khémisset
        'KHN', // Khénifra
        'KHO', // Khouribga
        'LAA', // Laâyoune
        'LAR', // Larache
        'MED', // Médiouna
        'MEK', // Meknès
        'MMD', // Marrakech-Medina
        'MMN', // Marrakech-Menara
        'MOH', // Mohammadia
        'MOU', // Moulay Yacoub
        'NAD', // Nador
        'NOU', // Nouaceur
        'OUA', // Ouarzazate
        'OUD', // Oued ed Dahab (EH)
        'OUJ', // Oujda-Angad
        'RAB', // Rabat
        'SAF', // Safi
        'SAL', // Salé
        'SEF', // Sefrou
        'SET', // Settat
        'SIK', // Sidi Kacem
        'SKH', // Skhirate-Témara
        'SYB', // Sidi Youssef Ben Ali
        'TAI', // Taourirt
        'TAO', // Taounate
        'TAR', // Taroudant
        'TAT', // Tata
        'TAZ', // Taza
        'TET', // Tétouan
        'TIZ', // Tiznit
        'TNG', // Tanger-Assilah
        'TNT', // Tan-Tan
        'ZAG', // Zagora
    ];

    public $compareIdentical = true;
}
