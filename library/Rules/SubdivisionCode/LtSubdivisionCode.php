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
 * Validates whether an input is subdivision code of Lithuania or not.
 *
 * ISO 3166-1 alpha-2: LT
 *
 * @see http://www.geonames.org/LT/administrative-division-lithuania.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LtSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Akmenė
           '02', // Alytaus miestas
           '03', // Alytus
           '04', // Anykščiai
           '05', // Birštono
           '06', // Biržai
           '07', // Druskininkai
           '08', // Elektrėnai
           '09', // Ignalina
           '10', // Jonava
           '11', // Joniškis
           '12', // Jurbarkas
           '13', // Kaišiadorys
           '14', // Kalvarijos
           '15', // Kauno miestas
           '16', // Kaunas
           '17', // Kazlų Rūdos
           '18', // Kėdainiai
           '19', // Kelmė
           '20', // Klaipėdos miestas
           '21', // Klaipėda
           '22', // Kretinga
           '23', // Kupiškis
           '24', // Lazdijai
           '25', // Marijampolė
           '26', // Mažeikiai
           '27', // Molėtai
           '28', // Neringa
           '29', // Pagėgiai
           '30', // Pakruojis
           '31', // Palangos miestas
           '32', // Panevėžio miestas
           '33', // Panevėžys
           '34', // Pasvalys
           '35', // Plungė
           '36', // Prienai
           '37', // Radviliškis
           '38', // Raseiniai
           '39', // Rietavo
           '40', // Rokiškis
           '41', // Šakiai
           '42', // Šalčininkai
           '43', // Šiaulių miestas
           '44', // Šiauliai
           '45', // Šilalė
           '46', // Šilutė
           '47', // Širvintos
           '48', // Skuodas
           '49', // Švenčionys
           '50', // Tauragė
           '51', // Telšiai
           '52', // Trakai
           '53', // Ukmergė
           '54', // Utena
           '55', // Varėna
           '56', // Vilkaviškis
           '57', // Vilniaus miestas
           '58', // Vilnius
           '59', // Visaginas
           '60', // Zarasai
           'AL', // Alytus
           'KL', // Klaipeda
           'KU', // Kaunas
           'MR', // Marijampole
           'PN', // Panevezys
           'SA', // Siauliai
           'TA', // Taurage
           'TE', // Telsiai
           'UT', // Utena
           'VL', // Vilnius
       ];
    }
}
