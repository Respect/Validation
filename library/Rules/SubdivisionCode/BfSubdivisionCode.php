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
 * Validates whether an input is subdivision code of Burkina Faso or not.
 *
 * ISO 3166-1 alpha-2: BF
 *
 * @see http://www.geonames.org/BF/administrative-division-burkina-faso.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BfSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
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
       ];
    }
}
