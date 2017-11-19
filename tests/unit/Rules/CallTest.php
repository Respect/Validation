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

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Call
 * @covers \Respect\Validation\Exceptions\CallException
 */
class CallTest extends TestCase
{
    public function thisIsASampleCallbackUsedInsideThisTest()
    {
        return [];
    }

    public function testCallbackValidatorShouldAcceptEmptyString(): void
    {
        $v = new Call('str_split', new ArrayVal());
        self::assertTrue($v->assert(''));
    }

    public function testCallbackValidatorShouldAcceptStringWithFunctionName(): void
    {
        $v = new Call('str_split', new ArrayVal());
        self::assertTrue($v->assert('test'));
    }

    public function testCallbackValidatorShouldAcceptArrayCallbackDefinition(): void
    {
        $v = new Call([$this, 'thisIsASampleCallbackUsedInsideThisTest'], new ArrayVal());
        self::assertTrue($v->assert('test'));
    }

    public function testCallbackValidatorShouldAcceptClosures(): void
    {
        $v = new Call(function () {
            return [];
        }, new ArrayVal());
        self::assertTrue($v->assert('test'));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\CallException
     */
    public function testCallbackFailedShouldThrowCallException(): void
    {
        $v = new Call('strrev', new ArrayVal());
        self::assertFalse($v->validate('test'));
        self::assertFalse($v->assert('test'));
    }
}
