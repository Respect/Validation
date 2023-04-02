<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use ReflectionException;
use ReflectionProperty;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function tmpfile;

/**
 * @group  rule
 *
 * @covers \Respect\Validation\Rules\Email
 *
 * @author Andrey Kolyshkin <a.kolyshkin@semrush.com>
 * @author Eduardo Gulias Davis <me@egulias.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class EmailTest extends RuleTestCase
{
    /**
     * @test
     */
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
            ->will(self::returnValue(true));

        $sut = new Email($emailValidator);

        self::assertTrue($sut->validate($input));
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $sut = self::sut();

        return [
            [$sut, 'test@test.com'],
            [$sut, 'mail+mail@gmail.com'],
            [$sut, 'mail.email@e.test.com'],
            [$sut, 'a@a.a'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $sut = self::sut();

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

    /**
     * @throws ReflectionException
     */
    private static function sut(): Email
    {
        $rule = new Email();

        $reflection = new ReflectionProperty(Email::class, 'validator');
        $reflection->setAccessible(true);
        $reflection->setValue($rule, null);

        return $rule;
    }
}
