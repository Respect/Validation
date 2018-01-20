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
 * Validates whether an input is subdivision code of Malawi or not.
 *
 * ISO 3166-1 alpha-2: MW
 *
 * @see http://www.geonames.org/MW/administrative-division-malawi.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MwSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'BA', // Balaka
           'BL', // Blantyre
           'C', // Central
           'CK', // Chikwawa
           'CR', // Chiradzulu
           'CT', // Chitipa
           'DE', // Dedza
           'DO', // Dowa
           'KR', // Karonga
           'KS', // Kasungu
           'LI', // Lilongwe
           'LK', // Likoma
           'MC', // Mchinji
           'MG', // Mangochi
           'MH', // Machinga
           'MU', // Mulanje
           'MW', // Mwanza
           'MZ', // Mzimba
           'N', // Northern
           'NB', // Nkhata Bay
           'NE', // Neno
           'NI', // Ntchisi
           'NK', // Nkhotakota
           'NS', // Nsanje
           'NU', // Ntcheu
           'PH', // Phalombe
           'RU', // Rumphi
           'S', // Southern
           'SA', // Salima
           'TH', // Thyolo
           'ZO', // Zomba
       ];
    }
}
