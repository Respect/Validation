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
 * Validator for Slovenia subdivision code.
 *
 * ISO 3166-1 alpha-2: SI
 *
 * @see http://www.geonames.org/SI/administrative-division-slovenia.html
 */
class SiSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '001', // Ajdovščina
        '002', // Beltinci
        '003', // Bled
        '004', // Bohinj
        '005', // Borovnica
        '006', // Bovec
        '007', // Brda
        '008', // Brezovica
        '009', // Brežice
        '010', // Tišina
        '011', // Celje
        '012', // Cerklje na Gorenjskem
        '013', // Cerknica
        '014', // Cerkno
        '015', // Črenšovci
        '016', // Črna na Koroškem
        '017', // Črnomelj
        '018', // Destrnik
        '019', // Divača
        '020', // Dobrepolje
        '021', // Dobrova-Polhov Gradec
        '022', // Dol pri Ljubljani
        '023', // Domžale
        '024', // Dornava
        '025', // Dravograd
        '026', // Duplek
        '027', // Gorenja Vas-Poljane
        '028', // Gorišnica
        '029', // Gornja Radgona
        '030', // Gornji Grad
        '031', // Gornji Petrovci
        '032', // Grosuplje
        '033', // Šalovci
        '034', // Hrastnik
        '035', // Hrpelje-Kozina
        '036', // Idrija
        '037', // Ig
        '038', // Ilirska Bistrica
        '039', // Ivančna Gorica
        '040', // Izola/Isola
        '041', // Jesenice
        '042', // Juršinci
        '043', // Kamnik
        '044', // Kanal
        '045', // Kidričevo
        '046', // Kobarid
        '047', // Kobilje
        '048', // Kočevje
        '049', // Komen
        '050', // Koper/Capodistria
        '051', // Kozje
        '052', // Kranj
        '053', // Kranjska Gora
        '054', // Krško
        '055', // Kungota
        '056', // Kuzma
        '057', // Laško
        '058', // Lenart
        '059', // Lendava/Lendva
        '060', // Litija
        '061', // Ljubljana
        '062', // Ljubno
        '063', // Ljutomer
        '064', // Logatec
        '065', // Loška Dolina
        '066', // Loški Potok
        '067', // Luče
        '068', // Lukovica
        '069', // Majšperk
        '070', // Maribor
        '071', // Medvode
        '072', // Mengeš
        '073', // Metlika
        '074', // Mežica
        '075', // Miren-Kostanjevica
        '076', // Mislinja
        '077', // Moravče
        '078', // Moravske Toplice
        '079', // Mozirje
        '080', // Murska Sobota
        '081', // Muta
        '082', // Naklo
        '083', // Nazarje
        '084', // Nova Gorica
        '085', // Novo Mesto
        '086', // Odranci
        '087', // Ormož
        '088', // Osilnica
        '089', // Pesnica
        '090', // Piran/Pirano
        '091', // Pivka
        '092', // Podčetrtek
        '093', // Podvelka
        '094', // Postojna
        '095', // Preddvor
        '096', // Ptuj
        '097', // Puconci
        '098', // Rače-Fram
        '099', // Radeče
        '100', // Radenci
        '101', // Radlje ob Dravi
        '102', // Radovljica
        '103', // Ravne na Koroškem
        '104', // Ribnica
        '105', // Rogašovci
        '106', // Rogaška Slatina
        '107', // Rogatec
        '108', // Ruše
        '109', // Semič
        '110', // Sevnica
        '111', // Sežana
        '112', // Slovenj Gradec
        '113', // Slovenska Bistrica
        '114', // Slovenske Konjice
        '115', // Starše
        '116', // Sveti Jurij
        '117', // Šenčur
        '118', // Šentilj
        '119', // Šentjernej
        '120', // Šentjur
        '121', // Škocjan
        '122', // Škofja Loka
        '123', // Škofljica
        '124', // Šmarje pri Jelšah
        '125', // Šmartno ob Paki
        '126', // Šoštanj
        '127', // Štore
        '128', // Tolmin
        '129', // Trbovlje
        '130', // Trebnje
        '131', // Tržič
        '132', // Turnišče
        '133', // Velenje
        '134', // Velike Lašče
        '135', // Videm
        '136', // Vipava
        '137', // Vitanje
        '138', // Vodice
        '139', // Vojnik
        '140', // Vrhnika
        '141', // Vuzenica
        '142', // Zagorje ob Savi
        '143', // Zavrč
        '144', // Zreče
        '146', // Železniki
        '147', // Žiri
        '148', // Benedikt
        '149', // Bistrica ob Sotli
        '150', // Bloke
        '151', // Braslovče
        '152', // Cankova
        '153', // Cerkvenjak
        '154', // Dobje
        '155', // Dobrna
        '156', // Dobrovnik-Dobronak
        '157', // Dolenjske Toplice
        '158', // Grad
        '159', // Hajdina
        '160', // Hoče-Slivnica
        '161', // Hodoš/Hodos
        '162', // Horjul
        '163', // Jezersko
        '164', // Komenda
        '165', // Kostel
        '166', // Križevci
        '167', // Lovrenc na Pohorju
        '168', // Markovci
        '169', // Miklavž na Dravskem polju
        '170', // Mirna Peč
        '171', // Oplotnica
        '172', // Podlehnik
        '173', // Polzela
        '174', // Prebold
        '175', // Prevalje
        '176', // Razkrižje
        '177', // Ribnica na Pohorju
        '178', // Selnica ob Dravi
        '179', // Sodražica
        '180', // Solčava
        '181', // Sveta Ana
        '182', // Sveti Andraž v Slovenskih goricah
        '183', // Šempeter-Vrtojba
        '184', // Tabor
        '185', // Trnovska vas
        '186', // Trzin
        '187', // Velika Polana
        '188', // Veržej
        '189', // Vransko
        '190', // Žalec
        '191', // Žetale
        '192', // Žirovnica
        '193', // Žužemberk
        '194', // Šmartno pri Litiji
        '195', // Apače
        '196', // Cirkulane
        '197', // Kosanjevica na Krki
        '198', // Makole
        '199', // Mokronog-Trebelno
        '200', // Poljčane
        '201', // Renče-Vogrsko
        '202', // Središče ob Dravi
        '203', // Straža
        '204', // Sveta Trojica v Slovenskih Goricah
        '205', // Sveti Tomaž
        '206', // Šmarješke Toplice
        '207', // Gorje
        '208', // Log-Dragomer
        '209', // Rečica ob Savinji
        '210', // Sveti Jurij v Slovenskih Goricah
        '211', // Šentrupert
        '212', // Mirna
        '213', // Ankaran
    ];

    public $compareIdentical = true;
}
