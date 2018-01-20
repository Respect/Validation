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
 * Validates whether an input is subdivision code of Russia or not.
 *
 * ISO 3166-1 alpha-2: RU
 *
 * @see http://www.geonames.org/RU/administrative-division-russia.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class RuSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AD', // Adygeya
           'AL', // Altai Republic
           'ALT', // Altai Krai
           'AMU', // Amur
           'ARK', // Arkhangelsk
           'AST', // Astrakhan
           'BA', // Bashkortostan
           'BEL', // Belgorod
           'BRY', // Bryansk
           'BU', // Buryatia
           'CE', // Chechnya
           'CHE', // Chelyabinsk
           'CHU', // Chukotka
           'CU', // Chuvashia
           'DA', // Dagestan
           'IN', // Ingushetia
           'IRK', // Irkutsk
           'IVA', // Ivanovo
           'KAM', // Kamchatka
           'KB', // Kabardino-Balkaria
           'KC', // Karachay-Cherkessia
           'KDA', // Krasnodar
           'KEM', // Kemerovo
           'KGD', // Kaliningrad
           'KGN', // Kurgan
           'KHA', // Khabarovsk
           'KHM', // Khantia-Mansia
           'KIR', // Kirov
           'KK', // Khakassia
           'KL', // Kalmykia
           'KLU', // Kaluga
           'KO', // Komi
           'KOS', // Kostroma
           'KR', // Karelia
           'KRS', // Kursk
           'KYA', // Krasnoyarsk
           'LEN', // Leningrad
           'LIP', // Lipetsk
           'MAG', // Magadan
           'ME', // Mari El
           'MO', // Mordovia
           'MOS', // Moscow (Province)
           'MOW', // Moscow (City)
           'MUR', // Murmansk
           'NEN', // Nenetsia
           'NGR', // Novgorod
           'NIZ', // Nizhny Novgorod
           'NVS', // Novosibirsk
           'OMS', // Omsk
           'ORE', // Orenburg
           'ORL', // Oryol
           'PER', // Perm
           'PNZ', // Penza
           'PRI', // Primorsky
           'PSK', // Pskov
           'ROS', // Rostov
           'RYA', // Ryazan
           'SA', // Sakha
           'SAK', // Sakhalin
           'SAM', // Samara
           'SAR', // Saratov
           'SE', // North Ossetia
           'SMO', // Smolensk
           'SPE', // St. Petersburg
           'STA', // Stavropol
           'SVE', // Sverdlovsk
           'TA', // Tatarstan
           'TAM', // Tambov
           'TOM', // Tomsk
           'TUL', // Tula
           'TVE', // Tver
           'TY', // Tuva
           'TYU', // Tyumen
           'UD', // Udmurtia
           'ULY', // Ulynovsk
           'VGG', // Volgograd
           'VLA', // Vladimir
           'VLG', // Vologda
           'VOR', // Voronezh
           'YAN', // Yamalia
           'YAR', // Yaroslavl
           'YEV', // Jewish Oblast
           'ZAB', // Zabaykal'skiy kray
       ];
    }
}
