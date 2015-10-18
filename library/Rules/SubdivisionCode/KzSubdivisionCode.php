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
 * Validator for Kazakhstan subdivision code.
 *
 * ISO 3166-1 alpha-2: KZ
 *
 * @link http://www.geonames.org/KZ/administrative-division-kazakhstan.html
 */
class KzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AKM', // Aqmola
        'AKT', // Aqtobe
        'ALA', // Almaty
        'ALM', // Almaty
        'AST', // Astana
        'ATY', // Atyrau
        'BAY', // Baykonyr
        'KAR', // Qaraghandy
        'KUS', // Qustanay
        'KZY', // Qyzylorda
        'MAN', // Mangghystau
        'PAV', // Paylodar
        'SEV', // Soltustik Qazaqstan
        'VOS', // Shyghys Qazaqstan
        'YUZ', // Ongtustik Qazaqstan
        'ZAP', // Baty Qazaqstan
        'ZHA', // Zhambyl
    ];

    public $compareIdentical = true;
}
