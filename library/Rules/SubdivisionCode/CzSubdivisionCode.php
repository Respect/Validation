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
 * Validator for Czechia subdivision code.
 *
 * ISO 3166-1 alpha-2: CZ
 *
 * @link http://www.geonames.org/CZ/administrative-division-czech-republic.html
 */
class CzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '10', // Prague - the Capital (Praha - hlavni mesto)
        '101', // Praha 1
        '102', // Praha 2
        '103', // Praha 3
        '104', // Praha 4
        '105', // Praha 5
        '106', // Praha 6
        '107', // Praha 7
        '108', // Praha 8
        '109', // Praha 9
        '110', // Praha 10
        '111', // Praha 11
        '112', // Praha 12
        '113', // Praha 13
        '114', // Praha 14
        '115', // Praha 15
        '116', // Praha 16
        '117', // Praha 17
        '118', // Praha 18
        '119', // Praha 19
        '120', // Praha 20
        '121', // Praha 21
        '122', // Praha 22
        '20', // Central Bohemian Region (Stredocesky kraj)
        '201', // Benešov
        '202', // Beroun
        '203', // Kladno
        '204', // Kolín
        '205', // Kutná Hora
        '206', // Mělník
        '207', // Mladá Boleslav
        '208', // Nymburk
        '209', // Praha-východ
        '20A', // Praha-západ
        '20B', // Příbram
        '20C', // Rakovník
        '31', // South Bohemian Region (Jihocesky kraj)
        '311', // České Budějovice
        '312', // Český Krumlov
        '313', // Jindřichův Hradec
        '314', // Písek
        '315', // Prachatice
        '316', // Strakonice
        '317', // Tábor
        '32', // Plzen( Region Plzensky kraj)
        '321', // Domažlice
        '322', // Klatovy
        '323', // Plzeň-město
        '324', // Plzeň-jih
        '325', // Plzeň-sever
        '326', // Rokycany
        '327', // Tachov
        '41', // Carlsbad Region  (Karlovarsky kraj)
        '411', // Cheb
        '412', // Karlovy Vary
        '413', // Sokolov
        '42', // Usti nad Labem Region (Ustecky kraj)
        '421', // Děčín
        '422', // Chomutov
        '423', // Litoměřice
        '424', // Louny
        '425', // Most
        '426', // Teplice
        '427', // Ústí nad Labem
        '51', // Liberec Region (Liberecky kraj)
        '511', // Česká Lípa
        '512', // Jablonec nad Nisou
        '513', // Liberec
        '514', // Semily
        '52', // Hradec Kralove Region (Kralovehradecky kraj)
        '521', // Hradec Králové
        '522', // Jičín
        '523', // Náchod
        '524', // Rychnov nad Kněžnou
        '525', // Trutnov
        '53', // Pardubice Region (Pardubicky kraj)
        '531', // Chrudim
        '532', // Pardubice
        '533', // Svitavy
        '534', // Ústí nad Orlicí
        '63', // Vysocina Region (kraj Vysocina)
        '631', // Havlíčkův Brod
        '632', // Jihlava
        '633', // Pelhřimov
        '634', // Třebíč
        '635', // Žd’ár nad Sázavou
        '64', // South Moravian Region (Jihomoravsky kraj)
        '641', // Blansko
        '642', // Brno-město
        '643', // Brno-venkov
        '644', // Břeclav
        '645', // Hodonín
        '646', // Vyškov
        '647', // Znojmo
        '71', // Olomouc Region (Olomoucky kraj)
        '711', // Jeseník
        '712', // Olomouc
        '713', // Prostĕjov
        '714', // Přerov
        '715', // Šumperk
        '72', // Zlin Region (Zlinsky kraj)
        '721', // Kromĕříž
        '722', // Uherské Hradištĕ
        '723', // Vsetín
        '724', // Zlín
        '80', // Moravian-Silesian Region (Moravskoslezsky kraj)
        '801', // Bruntál
        '802', // Frýdek - Místek
        '803', // Karviná
        '804', // Nový Jičín
        '805', // Opava
        '806', // Ostrava - město
    ];

    public $compareIdentical = true;
}
