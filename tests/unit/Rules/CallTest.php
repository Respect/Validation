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

use PHPUnit\Framework\TestCase;
use Respect\Validation\Validatable;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Call
 * @covers \Respect\Validation\Exceptions\CallException
 */
class CallTest extends TestCase
{
    private const CALLBACK_RETURN = [];

    public function thisIsASampleCallbackUsedInsideThisTest()
    {
        return self::CALLBACK_RETURN;
    }

    public function testCallbackValidatorShouldAcceptEmptyString(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('assert')
            ->with(['']);

        $v = new Call('str_split', $validatable);
        $v->assert('');
    }

    public function testCallbackValidatorShouldAcceptStringWithFunctionName(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('assert')
            ->with(['t', 'e', 's', 't']);

        $v = new Call('str_split', $validatable);
        $v->assert('test');
    }

    public function testCallbackValidatorShouldAcceptArrayCallbackDefinition(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('assert')
            ->with(self::CALLBACK_RETURN);

        $v = new Call([$this, 'thisIsASampleCallbackUsedInsideThisTest'], $validatable);
        $v->assert('test');
    }

    public function testCallbackValidatorShouldAcceptClosures(): void
    {
        $return = [];

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('assert')
            ->with($return);

        $v = new Call(
            function () use ($return) {
                return $return;
            },
            $validatable
        );
        $v->assert('test');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\CallException
     */
    public function testCallbackFailedShouldThrowCallException(): void
    {
        $v = new Call('strrev', new ArrayVal());
        self::assertFalse($v->validate('test'));
        $v->assert('test');
    }
}
