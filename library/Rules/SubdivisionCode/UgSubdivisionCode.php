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
 * @link http://www.geonames.org/UG/administrative-division-uganda.html
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
        '114', // Lyantonde
        '115', // Mityana
        '116', // Nakaseke
        '117', // Buikwe
        '118', // Bukomansimbi
        '119', // Butambala
        '120', // Buvuma
        '121', // Gomba
        '122', // Kalungu
        '123', // Kyankwanzi
        '124', // Lwengo
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
        '218', // Bududa
        '219', // Bukedea
        '220', // Bukwa
        '221', // Butaleja
        '222', // Kaliro
        '223', // Manafwa
        '224', // Namutumba
        '225', // Bulambuli
        '226', // Buyende
        '227', // Kibuku
        '228', // Kween
        '229', // Luuka
        '230', // Namayingo
        '231', // Ngora
        '232', // Serere
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
        '314', // Abim
        '315', // Amolatar
        '316', // Amuru
        '317', // Dokolo
        '318', // Kaabong
        '319', // Koboko
        '320', // Maracha
        '321', // Oyam
        '322', // Agago
        '323', // Alebtong
        '324', // Amudat
        '325', // Kole
        '326', // Lamwo
        '327', // Napak
        '328', // Nwoya
        '329', // Otuke
        '330', // Zombo
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
        '416', // Buliisa
        '417', // Ibanda
        '418', // Isingiro
        '419', // Kiruhura
        '420', // Buhweju
        '421', // Kiryandongo
        '422', // Kyegegwa
        '423', // Mitoma
        '424', // Ntoroko
        '425', // Rubirizi
        '426', // Sheema
        'C', // Central
        'E', // Eastern
        'N', // Northern
        'W', // Western
    ];

    public $compareIdentical = true;
}
