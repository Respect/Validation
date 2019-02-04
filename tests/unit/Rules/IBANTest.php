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

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\IBAN
 *
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
final class IBANTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $IBAN = new IBAN();

        return [
          'Sweden' => [$IBAN, 'SE35 5000 0000 0549 1000 0003'],
          'SwitzerlandNoSpaces' => [$IBAN, 'CH9300762011623852957'],
          'HungaryLowerCase' => [$IBAN, 'hu93 1160 0006 0000 0000 1234 5676'],
          'Germany' => [$IBAN, 'DE89 3704 0044 0532 0130 00'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $IBAN = new IBAN();

        return [
          'Array' => [$IBAN, []],
          'Number' => [$IBAN, 123456789],
          'Bool' => [$IBAN, true],
          'Object' => [$IBAN, new stdClass()],
          'Empty' => [$IBAN, ''],
          'Alpha' => [$IBAN, 'ABCDEFGHIKLMNOPQRSTVXYZ'],
          'Symbols' => [$IBAN, '&"\'(-_)@-*/+.'],
          'SwedenWrong' => [$IBAN, 'SE35 5000 5880 7742'],
          'SwitzerlandWrong' => [$IBAN, 'CH93 5000 5880 7742'],
          'HungaryWrong' => [$IBAN, 'HU42 5000 5880 7742'],
          'GermanydWrong' => [$IBAN, 'DE89 5000 5880 7742'],
        ];
    }
}
