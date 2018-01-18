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
 * Validates whether an input is subdivision code of Bosnia and Herzegovina or not.
 *
 * ISO 3166-1 alpha-2: BA
 *
 * @see http://www.geonames.org/BA/administrative-division-bosnia-and-herzegovina.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BaSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Unsko-sanski kanton
           '02', // Posavski kanton
           '03', // Tuzlanski kanton
           '04', // Zeničko-dobojski kanton
           '05', // Bosansko-podrinjski kanton
           '06', // Srednjobosanski kantonn
           '07', // Hercegovačko-neretvanski kanton
           '08', // Zapadnohercegovački kanton
           '09', // Kanton Sarajevo
           '10', // Kanton br. 10 (Livanjski kanton)
           'BIH', // Federacija Bosna i Hercegovina
           'BRC', // Brcko District
           'SRP', // Republika Srpska
       ];
    }
}
