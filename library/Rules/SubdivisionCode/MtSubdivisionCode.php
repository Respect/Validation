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
 * Validates whether an input is subdivision code of Malta or not.
 *
 * ISO 3166-1 alpha-2: MT
 *
 * @see http://www.geonames.org/MT/administrative-division-malta.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MtSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Attard
           '02', // Balzan
           '03', // Birgu
           '04', // Birkirkara
           '05', // Birzebbuga
           '06', // Bormla
           '07', // Dingli
           '08', // Fgura
           '09', // Floriana
           '10', // Fontana
           '11', // Gudja
           '12', // Gzira
           '13', // Ghajnsielem
           '14', // Gharb
           '15', // Gargur
           '16', // Ghasri
           '17', // Gaxaq
           '18', // Hamrun
           '19', // Iklin
           '20', // Isla
           '21', // Kalkara
           '22', // Kercem
           '23', // Kirkop
           '24', // Lija
           '25', // Luqa
           '26', // Marsa
           '27', // Marsaskala
           '28', // Marsaxlokk
           '29', // Mdina
           '30', // Melliea
           '31', // Mgarr
           '32', // Mosta
           '33', // Mqabba
           '34', // Msida
           '35', // Mtarfa
           '36', // Munxar
           '37', // Nadur
           '38', // Naxxar
           '39', // Paola
           '40', // Pembroke
           '41', // Pieta
           '42', // Qala
           '43', // Qormi
           '44', // Qrendi
           '45', // Rabat Għawdex
           '46', // Rabat Malta
           '47', // Safi
           '48', // San Giljan
           '49', // San Gwann
           '50', // San Lawrenz
           '51', // San Pawl il-Bahar
           '52', // Sannat
           '53', // Santa Lucija
           '54', // Santa Venera
           '55', // Siggiewi
           '56', // Sliema
           '57', // Swieqi
           '58', // Tarxien
           '59', // Ta Xbiex
           '60', // Valletta
           '61', // Xagra
           '62', // Xewkija
           '63', // Xgajra
           '64', // Zabbar
           '65', // Żebbuġ Għawdex
           '66', // Żebbuġ Malta
           '67', // Zejtun
           '68', // Zurrieq
       ];
    }
}
