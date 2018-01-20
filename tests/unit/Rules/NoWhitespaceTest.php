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
 * @covers \Respect\Validation\Rules\NoWhitespace
 * @covers \Respect\Validation\Exceptions\NoWhitespaceException
 */
class NoWhitespaceTest extends TestCase
{
    protected $noWhitespaceValidator;

    protected function setUp(): void
    {
        $this->noWhitespaceValidator = new NoWhitespace();
    }

    /**
     * @dataProvider providerForPass
     */
    public function testStringWithNoWhitespaceShouldPass($input): void
    {
        self::assertTrue($this->noWhitespaceValidator->__invoke($input));
        self::assertTrue($this->noWhitespaceValidator->check($input));
        self::assertTrue($this->noWhitespaceValidator->assert($input));
    }

    /**
     * @dataProvider providerForFail
     * @expectedException \Respect\Validation\Exceptions\NoWhitespaceException
     */
    public function testStringWithWhitespaceShouldFail($input): void
    {
        self::assertFalse($this->noWhitespaceValidator->__invoke($input));
        self::assertFalse($this->noWhitespaceValidator->assert($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\NoWhitespaceException
     */
    public function testStringWithLineBreaksShouldFail(): void
    {
        self::assertFalse($this->noWhitespaceValidator->__invoke("w\npoiur"));
        self::assertFalse($this->noWhitespaceValidator->assert("w\npoiur"));
    }

    public function providerForPass()
    {
        return [
            [''],
            [null],
            [0],
            ['wpoiur'],
            ['Foo'],
        ];
    }

    public function providerForFail()
    {
        return [
            [' '],
            ['w poiur'],
            ['      '],
            ["Foo\nBar"],
            ["Foo\tBar"],
        ];
    }

    /**
     * @issue 346
     * @expectedException \Respect\Validation\Exceptions\NoWhitespaceException
     */
    public function testArrayDoesNotThrowAWarning(): void
    {
        $this->noWhitespaceValidator->assert([]);
    }
}
