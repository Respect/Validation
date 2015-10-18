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
 * Validator for Czech Republic subdivision code.
 *
 * ISO 3166-1 alpha-2: CZ
 *
 * @link http://www.geonames.org/CZ/administrative-division-czech-republic.html
 */
class CzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'JC', // South Bohemian Region (Jihocesky kraj)
        'JM', // South Moravian Region (Jihomoravsky kraj)
        'KA', // Carlsbad Region  (Karlovarsky kraj)
        'KR', // Hradec Kralove Region (Kralovehradecky kraj)
        'LI', // Liberec Region (Liberecky kraj)
        'MO', // Moravian-Silesian Region (Moravskoslezsky kraj)
        'OL', // Olomouc Region (Olomoucky kraj)
        'PA', // Pardubice Region (Pardubicky kraj)
        'PL', // Plzen( Region Plzensky kraj)
        'PR', // Prague - the Capital (Praha - hlavni mesto)
        'ST', // Central Bohemian Region (Stredocesky kraj)
        'US', // Usti nad Labem Region (Ustecky kraj)
        'VY', // Vysocina Region (kraj Vysocina)
        'ZL', // Zlin Region (Zlinsky kraj)
        '101', // Praha 1
        '102', // Praha 2
        '103', // Praha 3
        '104', // Praha 4
        '105', // Praha 5
        '106', // Praha 6
        '107', // Praha 7
        '108', // Praha 8
        '109', // Praha 9
        '10A', // Praha 10
        '10B', // Praha 11
        '10C', // Praha 12
        '10D', // Praha 13
        '10E', // Praha 14
        '10F', // Praha 15
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
        '311', // České Budějovice
        '312', // Český Krumlov
        '313', // Jindřichův Hradec
        '314', // Písek
        '315', // Prachatice
        '316', // Strakonice
        '317', // Tábor
        '321', // Domažlice
        '322', // Klatovy
        '323', // Plzeň-město
        '324', // Plzeň-jih
        '325', // Plzeň-sever
        '326', // Rokycany
        '327', // Tachov
        '411', // Cheb
        '412', // Karlovy Vary
        '413', // Sokolov
        '421', // Děčín
        '422', // Chomutov
        '423', // Litoměřice
        '424', // Louny
        '425', // Most
        '426', // Teplice
        '427', // Ústí nad Labem
        '511', // Česká Lípa
        '512', // Jablonec nad Nisou
        '513', // Liberec
        '514', // Semily
        '521', // Hradec Králové
        '522', // Jičín
        '523', // Náchod
        '524', // Rychnov nad Kněžnou
        '525', // Trutnov
        '531', // Chrudim
        '532', // Pardubice
        '533', // Svitavy
        '534', // Ústí nad Orlicí
        '611', // Havlíčkův Brod
        '612', // Jihlava
        '613', // Pelhřimov
        '614', // Třebíč
        '615', // Žd’ár nad Sázavou
        '621', // Blansko
        '622', // Brno-město
        '623', // Brno-venkov
        '624', // Břeclav
        '625', // Hodonín
        '626', // Vyškov
        '627', // Znojmo
        '711', // Jeseník
        '712', // Olomouc
        '713', // Prostĕjov
        '714', // Přerov
        '715', // Šumperk
        '721', // Kromĕříž
        '722', // Uherské Hradištĕ
        '723', // Vsetín
        '724', // Zlín
        '801', // Bruntál
        '802', // Frýdek - Místek
        '803', // Karviná
        '804', // Nový Jičín
        '805', // Opava
        '806', // Ostrava - město
    ];

    public $compareIdentical = true;
}
