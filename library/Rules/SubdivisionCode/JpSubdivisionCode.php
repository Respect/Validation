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
 * Validator for Japan subdivision code.
 *
 * ISO 3166-1 alpha-2: JP
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class JpSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Hokkaido
        '02', // Aomori
        '03', // Iwate
        '04', // Miyagi
        '05', // Akita
        '06', // Yamagata
        '07', // Fukushima
        '08', // Ibaraki
        '09', // Tochigi
        '10', // Gunma
        '11', // Saitama
        '12', // Chiba
        '13', // Tokyo
        '14', // Kanagawa
        '15', // Niigata
        '16', // Toyama
        '17', // Ishikawa
        '18', // Fukui
        '19', // Yamanashi
        '20', // Nagano
        '21', // Gifu
        '22', // Shizuoka
        '23', // Aichi
        '24', // Mie
        '25', // Shiga
        '26', // Kyoto
        '27', // Osaka
        '28', // Hyogo
        '29', // Nara
        '30', // Wakayama
        '31', // Tottori
        '32', // Shimane
        '33', // Okayama
        '34', // Hiroshima
        '35', // Yamaguchi
        '36', // Tokushima
        '37', // Kagawa
        '38', // Ehime
        '39', // Kochi
        '40', // Fukuoka
        '41', // Saga
        '42', // Nagasaki
        '43', // Kumamoto
        '44', // Oita
        '45', // Miyazaki
        '46', // Kagoshima
        '47', // Okinawa
    ];

    public $compareIdentical = true;
}
