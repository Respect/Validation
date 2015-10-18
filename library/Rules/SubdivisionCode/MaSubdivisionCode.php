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
        '01', // Tanger-Tétouan
        '02', // Gharb-Chrarda-Beni Hssen
        '03', // Taza-Al Hoceima-Taounate
        '04', // Oriental
        '05', // Fès-Boulemane
        '06', // Meknès-Tafilalet
        '07', // Rabat-Salé-Zemmour-Zaër
        '08', // Grand Casablanca
        '09', // Chaouia-Ouardigha
        '10', // Doukkala-Abda
        '11', // Marrakech-Tensift-Al Haouz
        '12', // Tadla-Azilal
        '13', // Souss-Massa-Drâa
        '14', // Guelmim-Es Smara
        '15', // Laâyoune-Boujdour-Sakia El Hamra
        '16', // Oued ed Dahab-Lagouira
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
