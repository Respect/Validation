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
 * Validates whether an input is subdivision code of Japan or not.
 *
 * ISO 3166-1 alpha-2: JP
 *
 * @see http://www.geonames.org/JP/administrative-division-japan.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class JpSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Hokkaidō
           '02', // Aomori
           '03', // Iwate
           '04', // Miyagi
           '05', // Akita
           '06', // Yamagata
           '07', // Hukusima (Fukushima)
           '08', // Ibaraki
           '09', // Totigi (Tochigi)
           '10', // Gunma
           '11', // Saitama
           '12', // Tiba (Chiba)
           '13', // Tokyo
           '14', // Kanagawa
           '15', // Niigata
           '16', // Toyama
           '17', // Isikawa (Ishikawa)
           '18', // Hukui (Fukui)
           '19', // Yamanasi (Yamanashi)
           '20', // Nagano
           '21', // Gihu  (Gifu)
           '22', // Sizuoka (Shizuoka)
           '23', // Aiti (Aichi)
           '24', // Mie
           '25', // Siga (Shiga)
           '26', // Kyoto
           '27', // Osaka
           '28', // Hyogo
           '29', // Nara
           '30', // Wakayama
           '31', // Tottori
           '32', // Simane (Shimane)
           '33', // Okayama
           '34', // Hirosima (Hiroshima)
           '35', // Yamaguti (Yamaguchi)
           '36', // Tokusima (Tokushima)
           '37', // Kagawa
           '38', // Ehime
           '39', // Koti (Kochi)
           '40', // Hukuoka (Fukuoka)
           '41', // Saga
           '42', // Nagasaki
           '43', // Kumamoto
           '44', // Oita
           '45', // Miyazaki
           '46', // Kagosima (Kagoshima)
           '47', // Okinawa
       ];
    }
}
