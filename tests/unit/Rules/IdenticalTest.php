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
use stdClass;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Identical
 * @covers \Respect\Validation\Exceptions\IdenticalException
 */
class IdenticalTest extends TestCase
{
    /**
     * @dataProvider providerForIdentical
     */
    public function testInputIdenticalToExpectedValueShouldPass($compareTo, $input): void
    {
        $rule = new Identical($compareTo);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForNotIdentical
     */
    public function testInputNotIdenticalToExpectedValueShouldPass($compareTo, $input): void
    {
        $rule = new Identical($compareTo);

        self::assertFalse($rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\IdenticalException
     * @expectedExceptionMessage "42" must be identical as 42
     */
    public function testShouldThrowTheProperExceptionWhenFailure(): void
    {
        $rule = new Identical(42);
        $rule->check('42');
    }

    public function providerForIdentical()
    {
        $object = new stdClass();

        return [
            ['foo', 'foo'],
            [[], []],
            [$object, $object],
            [10, 10],
        ];
    }

    public function providerForNotIdentical()
    {
        return [
            [42, '42'],
            ['foo', 'bar'],
            [[1], []],
            [new stdClass(), new stdClass()],
        ];
    }
}
