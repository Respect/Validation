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
 * Validator for Macedonia subdivision code.
 *
 * ISO 3166-1 alpha-2: MK
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class MkSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Aerodrom
        '02', // Aračinovo
        '03', // Berovo
        '04', // Bitola
        '05', // Bogdanci
        '06', // Bogovinje
        '07', // Bosilovo
        '08', // Brvenica
        '09', // Butel
        '10', // Valandovo
        '11', // Vasilevo
        '12', // Vevčani
        '13', // Veles
        '14', // Vinica
        '15', // Vraneštica
        '16', // Vrapčište
        '17', // Gazi Baba
        '18', // Gevgelija
        '19', // Gostivar
        '20', // Gradsko
        '21', // Debar
        '22', // Debarca
        '23', // Delčevo
        '24', // Demir Kapija
        '25', // Demir Hisar
        '26', // Dojran
        '27', // Dolneni
        '28', // Drugovo
        '29', // Gjorče Petrov
        '30', // Želino
        '31', // Zajas
        '32', // Zelenikovo
        '33', // Zrnovci
        '34', // Ilinden
        '35', // Jegunovce
        '36', // Kavadarci
        '37', // Karbinci
        '38', // Karpoš
        '39', // Kisela Voda
        '40', // Kičevo
        '41', // Konče
        '42', // Kočani
        '43', // Kratovo
        '44', // Kriva Palanka
        '45', // Krivogaštani
        '46', // Kruševo
        '47', // Kumanovo
        '48', // Lipkovo
        '49', // Lozovo
        '50', // Mavrovo-i-Rostuša
        '51', // Makedonska Kamenica
        '52', // Makedonski Brod
        '53', // Mogila
        '54', // Negotino
        '55', // Novaci
        '56', // Novo Selo
        '57', // Oslomej
        '58', // Ohrid
        '59', // Petrovec
        '60', // Pehčevo
        '61', // Plasnica
        '62', // Prilep
        '63', // Probištip
        '64', // Radoviš
        '65', // Rankovce
        '66', // Resen
        '67', // Rosoman
        '68', // Saraj
        '69', // Sveti Nikole
        '70', // Sopište
        '71', // Staro Nagoričane
        '72', // Struga
        '73', // Strumica
        '74', // Studeničani
        '75', // Tearce
        '76', // Tetovo
        '77', // Centar
        '78', // Centar Župa
        '79', // Čair
        '80', // Čaška
        '81', // Češinovo-Obleševo
        '82', // Čučer Sandevo
        '83', // Štip
        '84', // Šuto Orizari
    ];

    public $compareIdentical = true;
}
