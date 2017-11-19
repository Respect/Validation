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
use PHPUnit\Framework\TestCase;

function class_exists($className)
{
    if (isset($GLOBALS['class_exists'][$className])) {
        return $GLOBALS['class_exists'][$className];
    }

    return \class_exists($className);
}

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Email
 * @covers \Respect\Validation\Exceptions\EmailException
 */
class EmailTest extends TestCase
{
    private function setEmailValidatorExists($value): void
    {
        $GLOBALS['class_exists'][EmailValidator::class] = (bool) $value;
        $GLOBALS['class_exists'][RFCValidation::class] = (bool) $value;
    }

    private function resetClassExists(): void
    {
        unset($GLOBALS['class_exists']);
    }

    private function getEmailValidatorMock()
    {
        $emailValidatorMock = $this
            ->getMockBuilder(EmailValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $emailValidatorMock;
    }

    protected function setUp(): void
    {
        $this->setEmailValidatorExists(false);
    }

    protected function tearDown(): void
    {
        $this->resetClassExists();
    }

    public function testShouldAcceptInstanceOfEmailValidatorOnConstructor(): void
    {
        $this->resetClassExists();

        $emailValidator = $this->getEmailValidatorMock();

        $rule = new Email($emailValidator);

        self::assertSame($emailValidator, $rule->getEmailValidator());
    }

    public function testShouldHaveADefaultInstanceOfEmailValidator(): void
    {
        $this->resetClassExists();

        $rule = new Email();

        self::assertInstanceOf(EmailValidator::class, $rule->getEmailValidator());
    }

    public function testShouldUseEmailValidatorWhenDefined(): void
    {
        $this->resetClassExists();

        $input = 'example@example.com';

        $emailValidator = $this->getEmailValidatorMock();
        $emailValidator
            ->expects($this->once())
            ->method('isValid')
            ->with($input, $this->isInstanceOf(RFCValidation::class))
            ->will($this->returnValue(true));

        $rule = new Email($emailValidator);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForValidEmail
     */
    public function testValidEmailShouldPass($validEmail): void
    {
        $validator = new Email();
        self::assertTrue($validator->__invoke($validEmail));
        self::assertTrue($validator->check($validEmail));
        self::assertTrue($validator->assert($validEmail));
    }

    /**
     * @dataProvider providerForInvalidEmail
     * @expectedException \Respect\Validation\Exceptions\EmailException
     */
    public function testInvalidEmailsShouldFailValidation($invalidEmail): void
    {
        $validator = new Email();
        self::assertFalse($validator->__invoke($invalidEmail));
        self::assertFalse($validator->assert($invalidEmail));
    }

    public function providerForValidEmail()
    {
        return [
            ['test@test.com'],
            ['mail+mail@gmail.com'],
            ['mail.email@e.test.com'],
            ['a@a.a'],
        ];
    }

    public function providerForInvalidEmail()
    {
        return [
            [''],
            ['test@test'],
            ['test'],
            ['test@тест.рф'],
            ['@test.com'],
            ['mail@test@test.com'],
            ['test.test@'],
            ['test.@test.com'],
            ['test@.test.com'],
            ['test@test..com'],
            ['test@test.com.'],
            ['.test@test.com'],
        ];
    }
}
