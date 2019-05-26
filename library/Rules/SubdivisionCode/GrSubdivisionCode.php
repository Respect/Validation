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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class GrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Aitolia kai Akarnania
        '03', // Voiotia
        '04', // Evvoias
        '05', // Evrytania
        '06', // Fthiotida
        '07', // Fokida
        '11', // Argolida
        '12', // Arkadia
        '13', // Achaïa
        '14', // Ileia
        '15', // Korinthia
        '16', // Lakonia
        '17', // Messinia
        '21', // Zakynthos
        '22', // Kerkyra
        '23', // Kefallonia
        '24', // Lefkada
        '31', // Arta
        '32', // Thesprotia
        '33', // Ioannina
        '34', // Preveza
        '41', // Karditsa
        '42', // Larisa
        '43', // Magnisia
        '44', // Trikala
        '51', // Grevena
        '52', // Drama
        '53', // Imathia
        '54', // Thessaloniki
        '55', // Kavala
        '56', // Kastoria
        '57', // Kilkis
        '58', // Kozani
        '59', // Pella
        '61', // Pieria
        '62', // Serres
        '63', // Florina
        '64', // Chalkidiki
        '69', // Agio Oros
        '71', // Evros
        '72', // Xanthi
        '73', // Rodopi
        '81', // Dodekanisos
        '82', // Kyklades
        '83', // Lesvos
        '84', // Samos
        '85', // Chios
        '91', // Irakleio
        '92', // Lasithi
        '93', // Rethymno
        '94', // Chania
        'A', // Anatoliki Makedonia kai Thraki
        'A1', // Attiki
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
