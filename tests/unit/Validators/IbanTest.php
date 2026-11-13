<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Mazen Touati <mazen_touati@hotmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function extension_loaded;

#[Group('validator')]
#[CoversClass(Iban::class)]
final class IbanTest extends RuleTestCase
{
    protected function setUp(): void
    {
        if (extension_loaded('bcmath')) {
            return;
        }

        $this->markTestSkipped('You need bcmath to execute this test');
    }

    /** @return iterable<array{Iban, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new Iban();

        return [
            'Belgium' => [$sut, 'BE71 0961 2345 6769'],
            'Benin' => [$sut, 'BJ66 BJ18 5011 0000 1400 0247 0305'],
            'Burkina Faso' => [$sut, 'BF42 BF08 4010 1900 7253 6000 0337'],
            'Cameroon' => [$sut, 'CM21 9100 1000 9020 0000 0990 107'],
            'Chad' => [$sut, 'TD89 6000 3000 2037 1047 6460 236'],
            'Comoros' => [$sut, 'KM46 0009 9000 0100 0007 2000 288'],
            'Congo' => [$sut, 'CG39 3000 8031 1061 0019 3601 118'],
            'Equatorial Guinea' => [$sut, 'GQ70 9500 1000 6000 0000 0996 079'],
            'France' => [$sut, 'FR76 3000 6000 0112 3456 7890 189'],
            'Gabon' => [$sut, 'GA21 4000 1090 7007 9710 0014 674'],
            'Germany' => [$sut, 'DE89 3704 0044 0532 0130 00'],
            'Greece' => [$sut, 'GR96 0810 0010 0000 0123 4567 890'],
            'Ivory Coast' => [$sut, 'CI93 CI05 9010 1012 1679 6710 0188'],
            'Mali' => [$sut, 'ML13 ML01 6012 0602 0401 4198 2888'],
            'Niger' => [$sut, 'NE58 NE09 5010 0316 0567 2500 0142'],
            'Romania' => [$sut, 'RO09 BCYP 0000 0012 3456 7890'],
            'Saudi Arabia' => [$sut, 'SA44 2000 0001 2345 6789 1234'],
            'Senegal' => [$sut, 'SN08 SN00 0010 0100 0000 2006 0145'],
            'Spain' => [$sut, 'ES79 2100 0813 6101 2345 6789'],
            'Sweden' => [$sut, 'SE35 5000 0000 0549 1000 0003'],
            'Switzerland' => [$sut, 'CH56 0483 5012 3456 7800 9'],
            'Switzerland without spaces' => [$sut, 'CH9300762011623852957'],
            'Togo' => [$sut, 'TG53 TG05 5017 0814 0941 5000 0453'],
            'United Kingdom' => [$sut, 'GB98 MIDL 0700 9312 3456 78'],
        ];
    }

    /** @return iterable<array{Iban, mixed}> */
    public static function providerForInvalidInput(): iterable
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
            'BeninWrongChecksum' => [$sut, 'BJ67 BJ18 5011 0000 1400 0247 0305'],
            'BeninTooShort' => [$sut, 'BJ94 BJ18 5011 0000 1400 0247 030'],
            'BeninTooLong' => [$sut, 'BJ18 BJ18 5011 0000 1400 0247 0305 0'],
            'CameroonTooLong' => [$sut, 'CM21 9100 1000 9020 0000 0990 1070'],
        ];
    }
}
