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
 * Validator for Greece subdivision code.
 *
 * ISO 3166-1 alpha-2: GR
 *
 * @link http://www.geonames.org/GR/administrative-division-greece.html
 */
class GrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Nomós Aitolías kai Akarnanías
        '03', // Nomós Voiotías
        '04', // Nomós Evvoías
        '05', // Nomós Evrytanías
        '06', // Nomós Fthiótidos
        '07', // Nomós Fokídos
        '11', // Nomós Argolídos
        '12', // Nomós Arkadías
        '13', // Nomós Achaḯas
        '14', // Nomós Ileías
        '15', // Nomós Korinthías
        '16', // Nomós Lakonías
        '17', // Nomós Messinías
        '21', // Nomós Zakýnthou
        '22', // Nomós Kerkýras
        '23', // Nomós Kefallinías
        '24', // Nomós Lefkádas
        '31', // Nomós Ártis
        '32', // Nomós Thesprotías
        '33', // Nomós Ioannínon
        '34', // Nomós Prevézis
        '41', // Nomós Kardhítsas
        '42', // Nomós Larísis
        '43', // Nomós Magnisías
        '44', // Nomós Trikálon
        '51', // Nomós Grevenón
        '52', // Nomós Drámas
        '53', // Nomós Imathías
        '54', // Nomós Thessaloníkis
        '55', // Nomós Kaválas
        '56', // Nomós Kastoriás
        '57', // Nomós Kilkís
        '58', // Nomós Kozánis
        '59', // Nomós Péllis
        '61', // Nomós Pierías
        '62', // Nomós Serrón
        '63', // Nomós Florínis
        '64', // Nomós Chalkidikís
        '69', // Agio Oros
        '71', // Nomós Évrou
        '72', // Nomós Xánthis
        '73', // Nomós Rodópis
        '81', // Nomós Dodekanísou
        '82', // Nomós Kykládon
        '83', // Nomós Lésvou
        '84', // Nomós Sámou
        '85', // Nomós Chíou
        '91', // Nomós Irakleíou
        '92', // Nomós Lasithíou
        '93', // Nomós Rethýmnis
        '94', // Nomós Chaniás
        'A', // Anatoliki Makedonia kai Thraki
        'A1', // Nomós Attikís
        'B', // Kentriki Makedonia
        'C', // Dytiki Makedonia
        'D', // Ipeiros
        'E', // Thessalia
        'F', // Ionia Nisia
        'G', // Dytiki Ellada
        'H', // Sterea Ellada
        'I', // Attiki
        'J', // Peloponnisos
        'K', // Voreio Aigaio
        'L', // Notio Aigaio
        'M', // Kriti
    ];

    public $compareIdentical = true;
}
