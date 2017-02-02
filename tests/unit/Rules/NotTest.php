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
 * @covers \Respect\Validation\Rules\Not
 * @covers \Respect\Validation\Exceptions\NotException
 */
class NotTest extends TestCase
{
    protected function setUp(): void
    {
        $this->markTestSkipped('Not needs to be refactored');
    }

    /**
     * @dataProvider providerForValidNot
     */
    public function testNot($v, $input): void
    {
        $not = new Not($v);
        self::assertTrue($not->assert($input));
    }

    /**
     * @dataProvider providerForInvalidNot
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     */
    public function testNotNotHaha($v, $input): void
    {
        $not = new Not($v);
        self::assertFalse($not->assert($input));
    }

    /**
     * @dataProvider providerForSetName
     */
    public function testNotSetName($v): void
    {
        $not = new Not($v);
        $not->setName('Foo');

        self::assertEquals('Foo', $not->getName());
        self::assertEquals('Foo', $v->getName());
    }

    public function providerForValidNot()
    {
        return [
            [new IntVal(), ''],
            [new IntVal(), 'aaa'],
        ];
    }

    public function providerForInvalidNot()
    {
        return [
            [new IntVal(), 123],
        ];
    }

    public function providerForSetName()
    {
        return [
            [new IntVal()],
            [new Not(new Not(new IntVal()))],
        ];
    }
}
