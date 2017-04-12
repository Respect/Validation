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
 * Validator for Thailand subdivision code.
 *
 * ISO 3166-1 alpha-2: TH
 *
 * @link http://www.geonames.org/TH/administrative-division-thailand.html
 */
class ThSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '10', // Bangkok
        '11', // Samut Prakan
        '12', // Nonthaburi
        '13', // Pathum Thani
        '14', // Phra Nakhon Si Ayutthaya
        '15', // Ang Thong
        '16', // Lop Buri
        '17', // Sing Buri
        '18', // Chai Nat
        '19', // Saraburi
        '20', // Chon Buri
        '21', // Rayong
        '22', // Chanthaburi
        '23', // Trat
        '24', // Chachoengsao
        '25', // Prachin Buri
        '26', // Nakhon Nayok
        '27', // Sa Kaeo
        '30', // Nakhon Ratchasima
        '31', // Buri Ram
        '32', // Surin
        '33', // Si Sa Ket
        '34', // Ubon Ratchathani
        '35', // Yasothon
        '36', // Chaiyaphum
        '37', // Amnat Charoen
        '38', // Bueng Kan
        '39', // Nong Bua Lam Phu
        '40', // Khon Kaen
        '41', // Udon Thani
        '42', // Loei
        '43', // Nong Khai
        '44', // Maha Sarakham
        '45', // Roi Et
        '46', // Kalasin
        '47', // Sakon Nakhon
        '48', // Nakhon Phanom
        '49', // Mukdahan
        '50', // Chiang Mai
        '51', // Lamphun
        '52', // Lampang
        '53', // Uttaradit
        '54', // Phrae
        '55', // Nan
        '56', // Phayao
        '57', // Chiang Rai
        '58', // Mae Hong Son
        '60', // Nakhon Sawan
        '61', // Uthai Thani
        '62', // Kamphaeng Phet
        '63', // Tak
        '64', // Sukhothai
        '65', // Phitsanulok
        '66', // Phichit
        '67', // Phetchabun
        '70', // Ratchaburi
        '71', // Kanchanaburi
        '72', // Suphanburi
        '73', // Nakhon Pathom
        '74', // Samut Sakhon
        '75', // Samut Songkhram
        '76', // Phetchaburi
        '77', // Prachuap Khiri Khan
        '80', // Nakhon Si Thammarat
        '81', // Krabi
        '82', // Phang Nga
        '83', // Phuket
        '84', // Surat Thani
        '85', // Ranong
        '86', // Chumpon
        '90', // Songkhla
        '91', // Satun
        '92', // Trang
        '93', // Phattalung
        '94', // Pattani
        '95', // Yala
        '96', // Narathiwat
        'S', // Pattaya
    ];

    public $compareIdentical = true;
}
