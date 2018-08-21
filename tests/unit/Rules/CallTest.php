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

use Exception;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Exceptions\AlwaysInvalidException;
use Respect\Validation\Exceptions\CallException;
use Respect\Validation\Validatable;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Call
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class CallTest extends TestCase
{
    /**
     * @test
     */
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

    /**
     * @test
     */
    public function assertShouldThrowCallExceptionWhenPhpTriggersAnError(): void
    {
        $input = [];
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::never())
            ->method('assert');

        $this->expectException(CallException::class);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    /**
     * @test
     */
    public function assertShouldThrowCallExceptionWhenCallableThrowsAnException(): void
    {
        $input = [];
        $callable = function (): void {
            throw new Exception();
        };

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::never())
            ->method('assert');

        $this->expectException(CallException::class);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    /**
     * @test
     */
    public function assertShouldThrowExceptionOfTheDefinedRule(): void
    {
        $input = 'something';
        $callable = 'trim';

        $rule = new AlwaysInvalid();

        $this->expectException(AlwaysInvalidException::class);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    /**
     * @test
     */
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

    /**
     * @test
     */
    public function checkShouldThrowCallExceptionWhenPhpTriggersAnError(): void
    {
        $input = [];
        $callable = 'trim';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::never())
            ->method('check');

        $this->expectException(CallException::class);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    /**
     * @test
     */
    public function checkShouldThrowCallExceptionWhenCallableThrowsAnException(): void
    {
        $input = [];
        $callable = function (): void {
            throw new Exception();
        };

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::never())
            ->method('check');

        $this->expectException(CallException::class);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
    }

    /**
     * @test
     */
    public function checkShouldThrowExceptionOfTheDefinedRule(): void
    {
        $rule = new AlwaysInvalid();

        $this->expectException(AlwaysInvalidException::class);

        $sut = new Call('trim', $rule);
        $sut->check('something');
    }

    /**
     * @test
     */
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

    /**
     * @test
     */
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

    /**
     * @test
     */
    public function validateShouldReturnFalseWhenDefinedRuleFails(): void
    {
        $sut = new Call('trim', new AlwaysInvalid());

        self::assertFalse($sut->validate('something'));
    }
}
