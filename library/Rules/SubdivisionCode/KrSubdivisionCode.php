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
 * Validator for South Korea subdivision code.
 *
 * ISO 3166-1 alpha-2: KR
 *
 * @link http://www.geonames.org/KR/administrative-division-south-korea.html
 */
class KrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '11', // Seoul Special City
        '26', // Busan Metropolitan City
        '27', // Daegu Metropolitan City
        '28', // Incheon Metropolitan City
        '29', // Gwangju Metropolitan City
        '30', // Daejeon Metropolitan City
        '31', // Ulsan Metropolitan City
        '41', // Gyeonggi-do
        '42', // Gangwon-do
        '43', // Chungcheongbuk-do
        '44', // Chungcheongnam-do
        '45', // Jeollabuk-do
        '46', // Jeollanam-do
        '47', // Gyeongsangbuk-do
        '48', // Gyeongsangnam-do
        '49', // Jeju-do
        '50', // Sejong
    ];

    public $compareIdentical = true;
}
