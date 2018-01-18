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
 * Validates whether an input is subdivision code of Turks and Caicos Islands or not.
 *
 * ISO 3166-1 alpha-2: TC
 *
 * @see http://www.geonames.org/TC/administrative-division-turks-and-caicos-islands.html
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class TcSubdivisionCode extends AbstractSearcher
{
    /**
     * {@inheritdoc}
     */
    protected function getDataSource(): array
    {
        return [
           'AC', // Ambergris Cays
           'DC', // Dellis Cay
           'EC', // East Caicos
           'FC', // French Cay
           'GT', // Grand Turk
           'LW', // Little Water Cay
           'MC', // Middle Caicos
           'NC', // North Caicos
           'PN', // Pine Cay
           'PR', // Providenciales
           'RC', // Parrot Cay
           'SC', // South Caicos
           'SL', // Salt Cay
           'WC', // West Caicos
       ];
    }
}
