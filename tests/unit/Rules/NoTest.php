<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\TestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\No
 * @covers Respect\Validation\Exceptions\NoException
 */
class NoTest extends TestCase
{
    public function testShouldUseDefaultPattern()
    {
        $rule = new No();

        $actualPattern = $rule->regex;
        $expectedPattern = '/^n(o(t|pe)?|ix|ay)?$/i';

        $this->assertEquals($expectedPattern, $actualPattern);
    }

    public function testShouldUseLocalPatternForNoExpressionWhenDefined()
    {
        if (!defined('NOEXPR')) {
            $this->markTestSkipped('Constant NOEXPR is not defined');

            return;
        }

        $rule = new No(true);

        $actualPattern = $rule->regex;
        $expectedPattern = '/'.nl_langinfo(NOEXPR).'/i';

        $this->assertEquals($expectedPattern, $actualPattern);
    }

    /**
     * @dataProvider validNoProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new No();

        $this->assertTrue($rule->validate($input));
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
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new No();

        $this->assertFalse($rule->validate($input));
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
