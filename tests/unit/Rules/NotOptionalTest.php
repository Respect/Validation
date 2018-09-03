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
 * @covers \Respect\Validation\Rules\NotOptional
 */
class NotOptionalTest extends TestCase
{
    /**
     * @dataProvider providerForNotOptional
     *
     * @test
     */
    public function shouldValidateWhenNotOptional($input): void
    {
        $rule = new NotOptional();

        self::assertTrue($rule->isValid($input));
    }

    /**
     * @dataProvider providerForOptional
     *
     * @test
     */
    public function shouldNotValidateWhenOptional($input): void
    {
        $rule = new NotOptional();

        self::assertFalse($rule->isValid($input));
    }

    public function providerForNotOptional()
    {
        return [
            [[]],
            [' '],
            [0],
            ['0'],
            [0],
            ['0.0'],
            [false],
            [['']],
            [[' ']],
            [[0]],
            [['0']],
            [[false]],
            [[[''], [0]]],
            [new stdClass()],
        ];
    }

    public function providerForOptional()
    {
        return [
            [null],
            [''],
        ];
    }
}
