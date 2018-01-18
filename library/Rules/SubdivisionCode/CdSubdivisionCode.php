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
 * Validates whether an input is subdivision code of Democratic Republic of the Congo or not.
 *
 * ISO 3166-1 alpha-2: CD
 *
 * @see http://www.geonames.org/CD/administrative-division-democratic-republic-of-the-congo.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CdSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BC', // Kongo Central
           'BU', // Bas-Uélé
           'EQ', // Equateur
           'HK', // Haut-Katanga
           'HL', // Haut-Lomami
           'HU', // Haut-Uélé
           'IT', // Ituri
           'KC', // Kasaï Central
           'KE', // Kasai-Oriental
           'KG', // Kwango
           'KL', // Kwilu
           'KN', // Kinshasa
           'KS', // Kasaï
           'LO', // Lomami
           'LU', // Lualaba
           'MA', // Maniema
           'MN', // Mai-Ndombe
           'MO', // Mongala
           'NK', // Nord-Kivu
           'NU', // Nord-Ubangi
           'SA', // Sankuru
           'SK', // Sud-Kivu
           'SU', // Sud-Ubangi
           'TA', // Tanganyika
           'TO', // Tshopo
           'TU', // Tshuapa
       ];
    }
}
