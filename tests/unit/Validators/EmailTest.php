<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Eduardo Gulias Davis <me@egulias.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Kir Kolyshkin <kolyshkin@gmail.com>
 * SPDX-FileContributor: Konstantin <kolodnitsky@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: paul karikari <paulkarikari1@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function tmpfile;

#[Group(' rule')]
#[CoversClass(Email::class)]
final class EmailTest extends RuleTestCase
{
    #[Test]
    public function shouldUseEmailValidatorToValidate(): void
    {
        $input = 'example@example.com';

        $emailValidator = $this->getMockBuilder(EmailValidator::class)
            ->disableOriginalConstructor()
            ->getMock();
        $emailValidator
            ->expects(self::once())
            ->method('isValid')
            ->with($input, self::isInstanceOf(RFCValidation::class))
            ->willReturn(true);

        $sut = new Email($emailValidator);

        self::assertValidInput($sut, $input);
    }

    /** @return iterable<array{Email, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new Email(null);

        return [
            [$sut, 'test@test.com'],
            [$sut, 'mail+mail@gmail.com'],
            [$sut, 'mail.email@e.test.com'],
            [$sut, 'a@a.a'],
        ];
    }

    /** @return iterable<array{Email, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new Email(null);

        return [
            [$sut, ''],
            [$sut, 'test'],
            [$sut, '@test.com'],
            [$sut, 'mail@test@test.com'],
            [$sut, 'test.test@'],
            [$sut, 'test.@test.com'],
            [$sut, 'test@.test.com'],
            [$sut, 'test@test..com'],
            [$sut, 'test@test.com.'],
            [$sut, '.test@test.com'],
            [$sut, []],
            [$sut, new stdClass()],
            [$sut, null],
            [$sut, tmpfile()],
        ];
    }
}
