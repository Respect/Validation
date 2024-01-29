<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ErrorException;
use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;

use function restore_error_handler;
use function set_error_handler;
use function trigger_error;

#[Group('rule')]
#[CoversClass(Call::class)]
final class CallTest extends TestCase
{
    private readonly ErrorException $errorException;

    #[Test]
    public function assertShouldExecuteCallable(): void
    {
        $input = ' input ';
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::once())
            ->method('assert')
            ->with($callable($input));

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    #[Test]
    public function assertShouldThrowCallExceptionWhenPhpTriggersAnError(): void
    {
        $input = [];
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::never())
            ->method('assert');

        $this->expectException(ValidationException::class);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    #[Test]
    public function assertShouldRestorePreviousPhpErrorHandler(): void
    {
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::once())
            ->method('assert');

        $sut = new Call($callable, $rule);
        $sut->assert('');

        self::expectExceptionObject($this->errorException);

        trigger_error('Forcing PHP to trigger an error');
    }

    #[Test]
    public function assertShouldThrowValidationExceptionWhenCallableThrowsAnException(): void
    {
        $input = [];
        $callable = static function (): void {
            throw new Exception();
        };

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::never())
            ->method('assert');

        $this->expectException(ValidationException::class);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    #[Test]
    public function assertShouldThrowExceptionOfTheDefinedRule(): void
    {
        $input = 'something';
        $callable = 'trim';

        $rule = new AlwaysInvalid();

        $this->expectException(ValidationException::class);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    #[Test]
    public function checkShouldExecuteCallable(): void
    {
        $input = ' input ';
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::once())
            ->method('check')
            ->with($callable($input));

        $sut = new Call($callable, $rule);
        $sut->check($input);
    }

    #[Test]
    public function checkShouldThrowValidationExceptionWhenPhpTriggersAnError(): void
    {
        $input = [];
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::never())
            ->method('check');

        $this->expectException(ValidationException::class);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    #[Test]
    public function checkShouldRestorePreviousPhpErrorHandler(): void
    {
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::once())
            ->method('check');

        $sut = new Call($callable, $rule);
        $sut->check('');

        self::expectExceptionObject($this->errorException);

        trigger_error('Forcing PHP to trigger an error');
    }

    #[Test]
    public function checkShouldThrowValidationExceptionWhenCallableThrowsAnException(): void
    {
        $input = [];
        $callable = static function (): void {
            throw new Exception();
        };

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::never())
            ->method('check');

        $this->expectException(ValidationException::class);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    #[Test]
    public function checkShouldThrowExceptionOfTheDefinedRule(): void
    {
        $rule = new AlwaysInvalid();

        $this->expectException(ValidationException::class);

        $sut = new Call('trim', $rule);
        $sut->check('something');
    }

    #[Test]
    public function validateShouldExecuteCallable(): void
    {
        $input = ' input ';
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::once())
            ->method('check')
            ->with($callable($input));

        $sut = new Call($callable, $rule);

        self::assertTrue($sut->validate($input));
    }

    #[Test]
    public function validateShouldReturnFalseWhenPhpTriggersAnError(): void
    {
        $input = [];
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::never())
            ->method('check');

        $sut = new Call($callable, $rule);

        self::assertFalse($sut->validate($input));
    }

    #[Test]
    public function validateShouldReturnFalseWhenDefinedRuleFails(): void
    {
        $sut = new Call('trim', new AlwaysInvalid());

        self::assertFalse($sut->validate('something'));
    }

    #[Test]
    public function validateShouldRestorePreviousPhpErrorHandler(): void
    {
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::once())
            ->method('check');

        $sut = new Call($callable, $rule);
        $sut->validate('');

        self::expectExceptionObject($this->errorException);

        trigger_error('Forcing PHP to trigger an error');
    }

    protected function setUp(): void
    {
        $this->errorException = new ErrorException('This is a PHP error');

        set_error_handler(function (): void {
            throw $this->errorException;
        });
    }

    protected function tearDown(): void
    {
        restore_error_handler();
    }
}
