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
 * Validator for Burkina Faso subdivision code.
 *
 * ISO 3166-1 alpha-2: BF
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class BfSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
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
        'BAL', // Balé
        'BAM', // Bam
        'BAN', // Banwa
        'BAZ', // Bazèga
        'BGR', // Bougouriba
        'BLG', // Boulgou
        'BLK', // Boulkiemdé
        'COM', // Comoé
        'GAN', // Ganzourgou
        'GNA', // Gnagna
        'GOU', // Gourma
        'HOU', // Houet
        'IOB', // Ioba
        'KAD', // Kadiogo
        'KEN', // Kénédougou
        'KMD', // Komondjari
        'KMP', // Kompienga
        'KOP', // Koulpélogo
        'KOS', // Kossi
        'KOT', // Kouritenga
        'KOW', // Kourwéogo
        'LER', // Léraba
        'LOR', // Loroum
        'MOU', // Mouhoun
        'NAM', // Namentenga
        'NAO', // Naouri
        'NAY', // Nayala
        'NOU', // Noumbiel
        'OUB', // Oubritenga
        'OUD', // Oudalan
        'PAS', // Passoré
        'PON', // Poni
        'SEN', // Séno
        'SIS', // Sissili
        'SMT', // Sanmatenga
        'SNG', // Sanguié
        'SOM', // Soum
        'SOR', // Sourou
        'TAP', // Tapoa
        'TUI', // Tui
        'YAG', // Yagha
        'YAT', // Yatenga
        'ZIR', // Ziro
        'ZON', // Zondoma
        'ZOU', // Zoundwéogo
    ];

    public $compareIdentical = true;
}
