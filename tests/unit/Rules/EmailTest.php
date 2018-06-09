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
use Respect\Validation\Test\RuleTestCase;

function class_exists($className)
{
    if (isset($GLOBALS['class_exists'][$className])) {
        return $GLOBALS['class_exists'][$className];
    }

    return \class_exists($className);
}
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

    public function providerForValidInput(): array
    {
        return [
            [new Email(), 'test@test.com'],
            [new Email(), 'mail+mail@gmail.com'],
            [new Email(), 'mail.email@e.test.com'],
            [new Email(), 'a@a.a'],
        ];
    }

    public function providerForInvalidInput(): array
    {
        return [
            [new Email(), ''],
            [new Email(), 'test'],
            [new Email(), '@test.com'],
            [new Email(), 'mail@test@test.com'],
            [new Email(), 'test.test@'],
            [new Email(), 'test.@test.com'],
            [new Email(), 'test@.test.com'],
            [new Email(), 'test@test..com'],
            [new Email(), 'test@test.com.'],
            [new Email(), '.test@test.com'],
        ];
    }
}
