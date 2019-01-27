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

use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\NoException
 * @covers \Respect\Validation\Rules\No
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class NoTest extends TestCase
{
    /**
     * @dataProvider validNoProvider
     *
     * @test
     */
    public function shouldValidatePatternAccordingToTheDefinedLocale($input): void
    {
        $rule = new No();

        self::assertTrue($rule->validate($input));
    }

    public function validNoProvider()
    {
        return [
            ['N'],
            ['Nay'],
            ['Nix'],
            ['No'],
            ['Nope'],
            ['Not'],
        ];
    }

    /**
     * @dataProvider invalidNoProvider
     *
     * @test
     */
    public function shouldNotValidatePatternAccordingToTheDefinedLocale($input): void
    {
        $rule = new No();

        self::assertFalse($rule->validate($input));
    }

    public function invalidNoProvider()
    {
        return [
            ['Donnot'],
            ['Never'],
            ['Niet'],
            ['Noooooooo'],
            ['Não'],
        ];
    }
}
