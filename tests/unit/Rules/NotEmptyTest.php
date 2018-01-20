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
 * @covers \Respect\Validation\Rules\NotEmpty
 * @covers \Respect\Validation\Exceptions\NotEmptyException
 */
class NotEmptyTest extends TestCase
{
    protected $object;

    protected function setUp(): void
    {
        $this->object = new NotEmpty();
    }

    /**
     * @dataProvider providerForNotEmpty
     */
    public function testStringNotEmpty($input): void
    {
        self::assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForEmpty
     * @expectedException \Respect\Validation\Exceptions\NotEmptyException
     */
    public function testStringEmpty($input): void
    {
        self::assertFalse($this->object->assert($input));
    }

    public function providerForNotEmpty()
    {
        return [
            [1],
            [' oi'],
            [[5]],
            [[0]],
            [new \stdClass()],
        ];
    }

    public function providerForEmpty()
    {
        return [
            [''],
            ['    '],
            ["\n"],
            [false],
            [null],
            [[]],
        ];
    }
}
