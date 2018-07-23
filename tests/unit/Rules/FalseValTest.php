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
 * @covers \Respect\Validation\Exceptions\FalseValException
 * @covers \Respect\Validation\Rules\FalseVal
 */
class FalseValTest extends TestCase
{
    /**
     * @dataProvider validFalseProvider
     *
     * @test
     */
    public function shouldValidatePatternAccordingToTheDefinedLocale($input): void
    {
        $rule = new FalseVal();

        self::assertTrue($rule->validate($input));
    }

    public function validFalseProvider()
    {
        return [
            [false],
            [0],
            ['0'],
            ['false'],
            ['off'],
            ['no'],
            ['FALSE'],
            ['OFF'],
            ['NO'],
            ['False'],
            ['Off'],
            ['No'],
        ];
    }

    /**
     * @dataProvider invalidFalseProvider
     *
     * @test
     */
    public function shouldNotValidatePatternAccordingToTheDefinedLocale($input): void
    {
        $rule = new FalseVal();

        self::assertFalse($rule->validate($input));
    }

    public function invalidFalseProvider()
    {
        return [
            [true],
            [1],
            ['1'],
            [0.5],
            [2],
            ['true'],
            ['on'],
            ['yes'],
            ['anything'],
        ];
    }
}
