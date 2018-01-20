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
 * Validates whether an input is subdivision code of Nigeria or not.
 *
 * ISO 3166-1 alpha-2: NG
 *
 * @see http://www.geonames.org/NG/administrative-division-nigeria.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NgSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AB', // Abia
           'AD', // Adamawa
           'AK', // Akwa Ibom
           'AN', // Anambra
           'BA', // Bauchi
           'BE', // Benue
           'BO', // Borno
           'BY', // Bayelsa
           'CR', // Cross River
           'DE', // Delta
           'EB', // Ebonyi
           'ED', // Edo
           'EK', // Ekiti
           'EN', // Enugu
           'FC', // Federal Capital Territory
           'GO', // Gombe
           'IM', // Imo
           'JI', // Jigawa
           'KD', // Kaduna
           'KE', // Kebbi
           'KN', // Kano
           'KO', // Kogi
           'KT', // Katsina
           'KW', // Kwara
           'LA', // Lagos
           'NA', // Nassarawa
           'NI', // Niger
           'OG', // Ogun
           'ON', // Ondo
           'OS', // Osun
           'OY', // Oyo
           'PL', // Plateau
           'RI', // Rivers
           'SO', // Sokoto
           'TA', // Taraba
           'YO', // Yobe
           'ZA', // Zamfara
       ];
    }
}
