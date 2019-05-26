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
 * Validator for Russia subdivision code.
 *
 * ISO 3166-1 alpha-2: RU
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class RuSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AD', // Adygeya, Respublika
        'AL', // Altay, Respublika
        'ALT', // Altayskiy kray
        'AMU', // Amurskaya oblast'
        'ARK', // Arkhangel'skaya oblast'
        'AST', // Astrakhanskaya oblast'
        'BA', // Bashkortostan, Respublika
        'BEL', // Belgorodskaya oblast'
        'BRY', // Bryanskaya oblast'
        'BU', // Buryatiya, Respublika
        'CE', // Chechenskaya Respublika
        'CHE', // Chelyabinskaya oblast'
        'CHU', // Chukotskiy avtonomnyy okrug
        'CU', // Chuvashskaya Respublika
        'DA', // Dagestan, Respublika
        'IN', // Respublika Ingushetiya
        'IRK', // Irkutiskaya oblast'
        'IVA', // Ivanovskaya oblast'
        'KAM', // Kamchatskiy kray
        'KB', // Kabardino-Balkarskaya Respublika
        'KC', // Karachayevo-Cherkesskaya Respublika
        'KDA', // Krasnodarskiy kray
        'KEM', // Kemerovskaya oblast'
        'KGD', // Kaliningradskaya oblast'
        'KGN', // Kurganskaya oblast'
        'KHA', // Khabarovskiy kray
        'KHM', // Khanty-Mansiysky avtonomnyy okrug-Yugra
        'KIR', // Kirovskaya oblast'
        'KK', // Khakasiya, Respublika
        'KL', // Kalmykiya, Respublika
        'KLU', // Kaluzhskaya oblast'
        'KO', // Komi, Respublika
        'KOS', // Kostromskaya oblast'
        'KR', // Kareliya, Respublika
        'KRS', // Kurskaya oblast'
        'KYA', // Krasnoyarskiy kray
        'LEN', // Leningradskaya oblast'
        'LIP', // Lipetskaya oblast'
        'MAG', // Magadanskaya oblast'
        'ME', // Mariy El, Respublika
        'MO', // Mordoviya, Respublika
        'MOS', // Moskovskaya oblast'
        'MOW', // Moskva
        'MUR', // Murmanskaya oblast'
        'NEN', // Nenetskiy avtonomnyy okrug
        'NGR', // Novgorodskaya oblast'
        'NIZ', // Nizhegorodskaya oblast'
        'NVS', // Novosibirskaya oblast'
        'OMS', // Omskaya oblast'
        'ORE', // Orenburgskaya oblast'
        'ORL', // Orlovskaya oblast'
        'PER', // Permskiy kray
        'PNZ', // Penzenskaya oblast'
        'PRI', // Primorskiy kray
        'PSK', // Pskovskaya oblast'
        'ROS', // Rostovskaya oblast'
        'RYA', // Ryazanskaya oblast'
        'SA', // Sakha, Respublika [Yakutiya]
        'SAK', // Sakhalinskaya oblast'
        'SAM', // Samaraskaya oblast'
        'SAR', // Saratovskaya oblast'
        'SE', // Severnaya Osetiya-Alaniya, Respublika
        'SMO', // Smolenskaya oblast'
        'SPE', // Sankt-Peterburg
        'STA', // Stavropol'skiy kray
        'SVE', // Sverdlovskaya oblast'
        'TA', // Tatarstan, Respublika
        'TAM', // Tambovskaya oblast'
        'TOM', // Tomskaya oblast'
        'TUL', // Tul'skaya oblast'
        'TVE', // Tverskaya oblast'
        'TY', // Tyva, Respublika [Tuva]
        'TYU', // Tyumenskaya oblast'
        'UD', // Udmurtskaya Respublika
        'ULY', // Ul'yanovskaya oblast'
        'VGG', // Volgogradskaya oblast'
        'VLA', // Vladimirskaya oblast'
        'VLG', // Vologodskaya oblast'
        'VOR', // Voronezhskaya oblast'
        'YAN', // Yamalo-Nenetskiy avtonomnyy okrug
        'YAR', // Yaroslavskaya oblast'
        'YEV', // Yevreyskaya avtonomnaya oblast'
        'ZAB', // Zabajkal'skij kraj
    ];

    public $compareIdentical = true;
}
