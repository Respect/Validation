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
 * Validator for United States subdivision code.
 *
 * ISO 3166-1 alpha-2: US
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class UsSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AK', // Alaska
        'AL', // Alabama
        'AR', // Arkansas
        'AS', // American Samoa
        'AZ', // Arizona
        'CA', // California
        'CO', // Colorado
        'CT', // Connecticut
        'DC', // District of Columbia
        'DE', // Delaware
        'FL', // Florida
        'GA', // Georgia
        'GU', // Guam
        'HI', // Hawaii
        'IA', // Iowa
        'ID', // Idaho
        'IL', // Illinois
        'IN', // Indiana
        'KS', // Kansas
        'KY', // Kentucky
        'LA', // Louisiana
        'MA', // Massachusetts
        'MD', // Maryland
        'ME', // Maine
        'MI', // Michigan
        'MN', // Minnesota
        'MO', // Missouri
        'MP', // Northern Mariana Islands
        'MS', // Mississippi
        'MT', // Montana
        'NC', // North Carolina
        'ND', // North Dakota
        'NE', // Nebraska
        'NH', // New Hampshire
        'NJ', // New Jersey
        'NM', // New Mexico
        'NV', // Nevada
        'NY', // New York
        'OH', // Ohio
        'OK', // Oklahoma
        'OR', // Oregon
        'PA', // Pennsylvania
        'PR', // Puerto Rico
        'RI', // Rhode Island
        'SC', // South Carolina
        'SD', // South Dakota
        'TN', // Tennessee
        'TX', // Texas
        'UM', // United States Minor Outlying Islands
        'UT', // Utah
        'VA', // Virginia
        'VI', // Virgin Islands
        'VT', // Vermont
        'WA', // Washington
        'WI', // Wisconsin
        'WV', // West Virginia
        'WY', // Wyoming
    ];

    public $compareIdentical = true;
}
