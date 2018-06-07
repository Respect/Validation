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

function class_exists(string $className): bool
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

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->setEmailValidatorExists(false);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        $this->resetClassExists();
    }

    /**
     * @test
     */
    public function shouldAcceptInstanceOfEmailValidatorOnConstructor(): void
    {
        $this->resetClassExists();

        $emailValidator = $this->getEmailValidatorMock();

        $rule = new Email($emailValidator);

        self::assertSame($emailValidator, $rule->getEmailValidator());
    }

    /**
     * @test
     */
    public function shouldHaveADefaultInstanceOfEmailValidator(): void
    {
        $this->resetClassExists();

        $rule = new Email();

        self::assertInstanceOf(EmailValidator::class, $rule->getEmailValidator());
    }

    /**
     * @test
     */
    public function shouldUseEmailValidatorWhenDefined(): void
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
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $email = new Email();

        return [
            [$email, 'test@test.com'],
            [$email, 'mail+mail@gmail.com'],
            [$email, 'mail.email@e.test.com'],
            [$email, 'a@a.a'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $email = new Email();

        return [
            [$email, ''],
            [$email, 'test'],
            [$email, '@test.com'],
            [$email, 'mail@test@test.com'],
            [$email, 'test.test@'],
            [$email, 'test.@test.com'],
            [$email, 'test@.test.com'],
            [$email, 'test@test..com'],
            [$email, 'test@test.com.'],
            [$email, '.test@test.com'],
        ];
    }
}
