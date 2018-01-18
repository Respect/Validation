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
 * Validates whether an input is subdivision code of Panama or not.
 *
 * ISO 3166-1 alpha-2: PA
 *
 * @see http://www.geonames.org/PA/administrative-division-panama.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class PaSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           '1', // Bocas del Toro
           '10', // Panamá Oeste Province
           '2', // Cocle
           '3', // Colon
           '4', // Chiriqui
           '5', // Darien
           '6', // Herrera
           '7', // Los Santos
           '8', // Panama
           '9', // Veraguas
           'EM', // Comarca Emberá-Wounaan
           'KY', // Comarca de Kuna Yala
           'NB', // Ngöbe-Buglé
       ];
    }
}
