<?php

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\AbstractSearcher;

/**
 * Turks and Caicos Islands country subdivision.
 *
 * ISO 3166-1 alpha-2: TC
 *
 * @link http://www.geonames.org/TC/administrative-division-turks-and-caicos-islands.html
 */
class TcCountrySubdivision extends AbstractSearcher
{
    public $haystack = array(
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
    );

    public $compareIdentical = true;
}
