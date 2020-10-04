<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function extension_loaded;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Iban
 *
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
final class IbanTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $sut = new Iban();

        return [
            'Belgium' => [$sut, 'BE71 0961 2345 6769'],
            'France' => [$sut, 'FR76 3000 6000 0112 3456 7890 189'],
            'Germany' => [$sut, 'DE89 3704 0044 0532 0130 00'],
            'Greece' => [$sut, 'GR96 0810 0010 0000 0123 4567 890'],
            'Romania' => [$sut, 'RO09 BCYP 0000 0012 3456 7890'],
            'Saudi Arabia' => [$sut, 'SA44 2000 0001 2345 6789 1234'],
            'Spain' => [$sut, 'ES79 2100 0813 6101 2345 6789'],
            'Sweden' => [$sut, 'SE35 5000 0000 0549 1000 0003'],
            'Switzerland' => [$sut, 'CH56 0483 5012 3456 7800 9'],
            'Switzerland without spaces' => [$sut, 'CH9300762011623852957'],
            'United Kingdom' => [$sut, 'GB98 MIDL 0700 9312 3456 78'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new Iban();

        return [
            'Array' => [$sut, []],
            'Number' => [$sut, 123456789],
            'Bool' => [$sut, true],
            'Object' => [$sut, new stdClass()],
            'Empty' => [$sut, ''],
            'Alpha' => [$sut, 'ABCDEFGHIKLMNOPQRSTVXYZ'],
            'Symbols' => [$sut, '&"\'(-_)@-*/+.'],
            'SwedenWrong' => [$sut, 'SE35 5000 5880 7742'],
            'SwitzerlandWrong' => [$sut, 'CH93 5000 5880 7742'],
            'HungaryWrong' => [$sut, 'HU42 5000 5880 7742'],
            'GermanydWrong' => [$sut, 'DE89 5000 5880 7742'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        if (extension_loaded('bcmath')) {
            return;
        }

        $this->markTestSkipped('You need bcmath to execute this test');
    }
}
