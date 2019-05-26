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
 * Validator for Uganda subdivision code.
 *
 * ISO 3166-1 alpha-2: UG
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class UgSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '101', // Kalangala
        '102', // Kampala
        '103', // Kiboga
        '104', // Luwero
        '105', // Masaka
        '106', // Mpigi
        '107', // Mubende
        '108', // Mukono
        '109', // Nakasongola
        '110', // Rakai
        '111', // Sembabule
        '112', // Kayunga
        '113', // Wakiso
        '114', // Mityana
        '115', // Nakaseke
        '116', // Lyantonde
        '201', // Bugiri
        '202', // Busia
        '203', // Iganga
        '204', // Jinja
        '205', // Kamuli
        '206', // Kapchorwa
        '207', // Katakwi
        '208', // Kumi
        '209', // Mbale
        '210', // Pallisa
        '211', // Soroti
        '212', // Tororo
        '213', // Kaberamaido
        '214', // Mayuge
        '215', // Sironko
        '216', // Amuria
        '217', // Budaka
        '218', // Bukwa
        '219', // Butaleja
        '220', // Kaliro
        '221', // Manafwa
        '222', // Namutumba
        '223', // Bududa
        '224', // Bukedea
        '301', // Adjumani
        '302', // Apac
        '303', // Arua
        '304', // Gulu
        '305', // Kitgum
        '306', // Kotido
        '307', // Lira
        '308', // Moroto
        '309', // Moyo
        '310', // Nebbi
        '311', // Nakapiripirit
        '312', // Pader
        '313', // Yumbe
        '314', // Amolatar
        '315', // Kaabong
        '316', // Koboko
        '317', // Abim
        '318', // Dokolo
        '319', // Amuru
        '320', // Maracha
        '321', // Oyam
        '401', // Bundibugyo
        '402', // Bushenyi
        '403', // Hoima
        '404', // Kabale
        '405', // Kabarole
        '406', // Kasese
        '407', // Kibaale
        '408', // Kisoro
        '409', // Masindi
        '410', // Mbarara
        '411', // Ntungamo
        '412', // Rukungiri
        '413', // Kamwenge
        '414', // Kanungu
        '415', // Kyenjojo
        '416', // Ibanda
        '417', // Isingiro
        '418', // Kiruhura
        '419', // Buliisa
        'C', // Central
        'E', // Eastern
        'N', // Northern
        'W', // Western
    ];

    public $compareIdentical = true;
}
