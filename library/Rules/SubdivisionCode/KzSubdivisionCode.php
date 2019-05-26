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
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class KzSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'AKM', // Aqmola oblysy
        'AKT', // Aqtöbe oblysy
        'ALA', // Almaty
        'ALM', // Almaty oblysy
        'AST', // Astana
        'ATY', // Atyraū oblysy
        'KAR', // Qaraghandy oblysy
        'KUS', // Qostanay oblysy
        'KZY', // Qyzylorda oblysy
        'MAN', // Mangghystaū oblysy
        'PAV', // Pavlodar oblysy
        'SEV', // Soltüstik Quzaqstan oblysy
        'VOS', // Shyghys Qazaqstan oblysy
        'YUZ', // Ongtüstik Qazaqstan oblysy
        'ZAP', // Batys Quzaqstan oblysy
        'ZHA', // Zhambyl oblysy
    ];

    public $compareIdentical = true;
}
