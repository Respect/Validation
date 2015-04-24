<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Burkina Faso country subdivision.
 *
 * ISO 3166-1 alpha-2: BF
 *
 * @link http://www.geonames.org/BF/administrative-division-burkina-faso.html
 */
class BfCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
        '01', // Boucle du Mouhoun
        '02', // Cascades
        '03', // Centre
        '04', // Centre-Est
        '05', // Centre-Nord
        '06', // Centre-Ouest
        '07', // Centre-Sud
        '08', // Est
        '09', // Hauts-Bassins
        '10', // Nord
        '11', // Plateau-Central
        '12', // Sahel
        '13', // Sud-Ouest
        'BAL', // Bale
        'BAM', // Bam
        'BAN', // Banwa
        'BAZ', // Bazega
        'BGR', // Bougouriba
        'BLG', // Boulgou
        'BLK', // Boulkiemde
        'COM', // Comoe
        'GAN', // Ganzourgou
        'GNA', // Gnagna
        'GOU', // Gourma
        'HOU', // Houet
        'IOB', // Ioba
        'KAD', // Kadiogo
        'KEN', // Kenedougou
        'KMD', // Komondjari
        'KMP', // Kompienga
        'KOP', // Koulpelogo
        'KOS', // Kossi
        'KOT', // Kouritenga
        'KOW', // Kourweogo
        'LER', // Leraba
        'LOR', // Loroum
        'MOU', // Mouhoun
        'NAM', // Namentenga
        'NAO', // Nahouri
        'NAY', // Nayala
        'NOU', // Noumbiel
        'OUB', // Oubritenga
        'OUD', // Oudalan
        'PAS', // Passore
        'PON', // Poni
        'SEN', // Seno
        'SIS', // Sissili
        'SMT', // Sanmatenga
        'SNG', // Sanguie
        'SOM', // Soum
        'SOR', // Sourou
        'TAP', // Tapoa
        'TUI', // Tuy
        'YAG', // Yagha
        'YAT', // Yatenga
        'ZIR', // Ziro
        'ZON', // Zondoma
        'ZOU', // Zoundweogo
    );

    public $compareIdentical = true;
}
