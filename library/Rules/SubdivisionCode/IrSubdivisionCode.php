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
 * Validator for Iran subdivision code.
 *
 * ISO 3166-1 alpha-2: IR
 *
 * @link https://salsa.debian.org/iso-codes-team/iso-codes
 */
class IrSubdivisionCode extends AbstractSearcher
{
    public $haystack = [
        '01', // Āzarbāyjān-e Sharqī
        '02', // Āzarbāyjān-e Gharbī
        '03', // Ardabīl
        '04', // Eşfahān
        '05', // Īlām
        '06', // Būshehr
        '07', // Tehrān
        '08', // Chahār Mahāll va Bakhtīārī
        '10', // Khūzestān
        '11', // Zanjān
        '12', // Semnān
        '13', // Sīstān va Balūchestān
        '14', // Fārs
        '15', // Kermān
        '16', // Kordestān
        '17', // Kermānshāh
        '18', // Kohgīlūyeh va Būyer Ahmad
        '19', // Gīlān
        '20', // Lorestān
        '21', // Māzandarān
        '22', // Markazī
        '23', // Hormozgān
        '24', // Hamadān
        '25', // Yazd
        '26', // Qom
        '27', // Golestān
        '28', // Qazvīn
        '29', // Khorāsān-e Janūbī
        '30', // Khorāsān-e Razavī
        '31', // Khorāsān-e Shemālī
    ];

    public $compareIdentical = true;
}
