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
 * Validates whether an input is subdivision code of Chad or not.
 *
 * ISO 3166-1 alpha-2: TD
 *
 * @see http://www.geonames.org/TD/administrative-division-chad.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class TdSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BA', // Batha
           'BG', // Barh el Ghazel
           'BO', // Borkou
           'CB', // Chari-Baguirmi
           'EE', // Ennedi Est
           'EO', // Ennedi Quest
           'GR', // Guéra
           'HL', // Hadjer-Lamis
           'KA', // Kanem
           'LC', // Lac
           'LO', // Logone Occidental
           'LR', // Logone Oriental
           'MA', // Mandoul
           'MC', // Moyen-Chari
           'ME', // Mayo-Kebbi Est
           'MO', // Mayo-Kebbi Ouest
           'ND', // Ville de N'Djamena
           'OD', // Ouaddaï
           'SA', // Salamat
           'SI', // Sila
           'TA', // Tandjile
           'TI', // Tibesti
           'WF', // Wadi Fira
       ];
    }
}
