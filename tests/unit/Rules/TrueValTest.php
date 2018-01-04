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
 * @covers \Respect\Validation\Rules\TrueVal
 * @covers \Respect\Validation\Exceptions\TrueValException
 */
class TrueValTest extends TestCase
{
    /**
     * @dataProvider validTrueProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedLocale($input): void
    {
        $rule = new TrueVal();

        self::assertTrue($rule->validate($input));
    }

    public function validTrueProvider()
    {
        return [
            [true],
            [1],
            ['1'],
            ['true'],
            ['on'],
            ['yes'],
            ['TRUE'],
            ['ON'],
            ['YES'],
            ['True'],
            ['On'],
            ['Yes'],
        ];
    }

    /**
     * @dataProvider invalidTrueProvider
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedLocale($input): void
    {
        $rule = new TrueVal();

        self::assertFalse($rule->validate($input));
    }

    public function invalidTrueProvider()
    {
        return [
            [false],
            [0],
            [0.5],
            [2],
            ['0'],
            ['false'],
            ['off'],
            ['no'],
            ['truth'],
        ];
    }
}
