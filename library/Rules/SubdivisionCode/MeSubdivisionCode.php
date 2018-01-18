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
 * Validates whether an input is subdivision code of Montenegro or not.
 *
 * ISO 3166-1 alpha-2: ME
 *
 * @see http://www.geonames.org/ME/administrative-division-montenegro.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MeSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '01', // Opština Andrijevica
           '02', // Opština Bar
           '03', // Opština Berane
           '04', // Opština Bijelo Polje
           '05', // Opština Budva
           '06', // Opština Cetinje
           '07', // Opština Danilovgrad
           '08', // Opština Herceg-Novi
           '09', // Opština Kolašin
           '10', // Opština Kotor
           '11', // Opština Mojkovac
           '12', // Opština Nikšić
           '13', // Opština Plav
           '14', // Opština Pljevlja
           '15', // Opština Plužine
           '16', // Opština Podgorica
           '17', // Opština Rožaje
           '18', // Opština Šavnik
           '19', // Opština Tivat
           '20', // Opština Ulcinj
           '21', // Opština Žabljak
           '22', // Gusinje
           '23', // Petnjica
       ];
    }
}
