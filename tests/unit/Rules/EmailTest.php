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

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use ReflectionException;
use ReflectionProperty;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 *
 * @covers \Respect\Validation\Rules\Email
 *
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
     * {@inheritdoc}
     *
     * @throws ReflectionException
     */
    public function providerForValidInput(): array
    {
        $sut = $this->createSutWithoutEmailValidator();

        return [
            [$sut, 'test@test.com'],
            [$sut, 'mail+mail@gmail.com'],
            [$sut, 'mail.email@e.test.com'],
            [$sut, 'a@a.a'],
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @throws ReflectionException
     */
    public function providerForInvalidInput(): array
    {
        $sut = $this->createSutWithoutEmailValidator();

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
        ];
    }

    /**
     * @throws ReflectionException
     *
     * @return Email
     */
    private function createSutWithoutEmailValidator(): Email
    {
        $rule = new Email();

        $reflection = new ReflectionProperty(Email::class, 'validator');
        $reflection->setAccessible(true);
        $reflection->setValue($rule, null);

        return $rule;
    }
}
