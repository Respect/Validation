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
 * Validator for Chad subdivision code.
 *
 * ISO 3166-1 alpha-2: TD
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class TdSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        'BA', // Al Baṭḩah
        'BG', // Baḩr al Ghazāl
        'BO', // Būrkū
        'CB', // Shārī Bāqirmī
        'EN', // Innīdī
        'GR', // Qīrā
        'HL', // Ḥajjar Lamīs
        'KA', // Kānim
        'LC', // Al Buḩayrah
        'LO', // Lūqūn al Gharbī
        'LR', // Lūqūn ash Sharqī
        'MA', // Māndūl
        'MC', // Shārī al Awsaṭ
        'ME', // Māyū Kībbī ash Sharqī
        'MO', // Māyū Kībbī al Gharbī
        'ND', // Madīnat Injamīnā
        'OD', // Waddāy
        'SA', // Salāmāt
        'SI', // Sīlā
        'TA', // Tānjilī
        'TI', // Tibastī
        'WF', // Wādī Fīrā
    ];

    public $compareIdentical = true;
}
