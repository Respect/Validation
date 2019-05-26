<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\SubdivisionCode;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Validator for Turks and Caicos Islands subdivision code.
 *
 * ISO 3166-1 alpha-2: TC
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class TcSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
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

    public $compareIdentical = true;
}
