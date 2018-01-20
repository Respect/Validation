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
 * Validates whether an input is subdivision code of Turkey or not.
 *
 * ISO 3166-1 alpha-2: TR
 *
 * @see http://www.geonames.org/TR/administrative-division-turkey.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class TrSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Adana
           '02', // Adiyaman
           '03', // Afyonkarahisar
           '04', // Agri
           '05', // Amasya
           '06', // Ankara
           '07', // Antalya
           '08', // Artvin
           '09', // Aydin
           '10', // Balikesir
           '11', // Bilecik
           '12', // Bingol
           '13', // Bitlis
           '14', // Bolu
           '15', // Burdur
           '16', // Bursa
           '17', // Canakkale
           '18', // Cankiri
           '19', // Corum
           '20', // Denizli
           '21', // Diyarbakir
           '22', // Edirne
           '23', // Elazig
           '24', // Erzincan
           '25', // Erzurum
           '26', // Eskisehir
           '27', // Gaziantep
           '28', // Giresun
           '29', // Gumushane
           '30', // Hakkari
           '31', // Hatay
           '32', // Isparta
           '33', // Mersin
           '34', // Istanbul
           '35', // Izmir
           '36', // Kars
           '37', // Kastamonu
           '38', // Kayseri
           '39', // Kirklareli
           '40', // Kirsehir
           '41', // Kocaeli
           '42', // Konya
           '43', // Kutahya
           '44', // Malatya
           '45', // Manisa
           '46', // Kahramanmaras
           '47', // Mardin
           '48', // Mugla
           '49', // Mus
           '50', // Nevsehir
           '51', // Nigde
           '52', // Ordu
           '53', // Rize
           '54', // Sakarya
           '55', // Samsun
           '56', // Siirt
           '57', // Sinop
           '58', // Sivas
           '59', // Tekirdag
           '60', // Tokat
           '61', // Trabzon
           '62', // Tunceli
           '63', // Sanliurfa
           '64', // Usak
           '65', // Van
           '66', // Yozgat
           '67', // Zonguldak
           '68', // Aksaray
           '69', // Bayburt
           '70', // Karaman
           '71', // Kirikkale
           '72', // Batman
           '73', // Sirnak
           '74', // Bartin
           '75', // Ardahan
           '76', // Igdir
           '77', // Yalova
           '78', // Karabuk
           '79', // Kilis
           '80', // Osmaniye
           '81', // Duzce
       ];
    }
}
