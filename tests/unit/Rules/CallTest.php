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
use Respect\Validation\Test\Exceptions\StubException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;

use function array_fill;
use function set_error_handler;
use function trigger_error;

#[Group('rule')]
#[CoversClass(Call::class)]
final class CallTest extends RuleTestCase
{
    #[Test]
    public function itShouldExecuteCallable(): void
    {
        $input = ' input ';
        $callable = 'trim';

        $rule = Stub::pass(3);

        $sut = new Call($callable, $rule);
        $sut->assert($input);
        $sut->check($input);
        $sut->validate($input);

        self::assertSame(array_fill(0, 3, $callable($input)), $rule->inputs);
    }

    #[Test]
    public function itShouldInvalidateWhenPhpTriggersAnError(): void
    {
        $input = [];
        $callable = 'trim';

        $rule = Stub::fail(1);

        $sut = new Call($callable, $rule);

        self::assertFalse($sut->validate($input));
        try {
            $sut->check($input);
            self::fail('An expected exception has not been raised');
        } catch (ValidationException $exception) {
            self::assertNotInstanceOf(StubException::class, $exception);
        }

        try {
            $sut->assert($input);
            self::fail('An expected exception has not been raised');
        } catch (ValidationException $exception) {
            self::assertNotInstanceOf(StubException::class, $exception);
        }
    }

    #[Test]
    public function itShouldRestorePreviousPhpErrorHandler(): void
    {
        $callable = 'trim';

        $rule = Stub::pass(3);

        $errorException = new ErrorException('This is a PHP error');

        set_error_handler(static fn () => throw $errorException);

        $sut = new Call($callable, $rule);
        $sut->assert('');
        $sut->check('');
        $sut->validate('');

        self::expectExceptionObject($errorException);

        trigger_error('Forcing PHP to trigger an error');
    }

    /** @return iterable<string, array{Call, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            'valid rule and valid callable' => [new Call('trim', Stub::pass(1)), ' input '],
        ];
    }

    /** @return iterable<string, array{Call, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            'PHP error' => [new Call('trim', Stub::pass(1)), []],
            'exception' => [new Call(static fn() => throw new Exception(), Stub::pass(1)), []],
        ];
    }
}
