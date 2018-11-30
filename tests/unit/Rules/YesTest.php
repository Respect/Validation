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
 * @covers Respect\Validation\Rules\Yes
 * @covers Respect\Validation\Exceptions\YesException
 */
class YesTest extends TestCase
{
    public function testShouldUseDefaultPattern()
    {
        $rule = new Yes();

        $actualPattern = $rule->regex;
        $expectedPattern = '/^y(eah?|ep|es)?$/i';

        $this->assertEquals($expectedPattern, $actualPattern);
    }

    public function testShouldUseLocalPatternForYesExpressionWhenDefined()
    {
        if (!defined('YESEXPR')) {
            $this->markTestSkipped('Constant YESEXPR is not defined');

            return;
        }

        $rule = new Yes(true);

        $actualPattern = $rule->regex;
        $expectedPattern = '/'.nl_langinfo(YESEXPR).'/i';

        $this->assertEquals($expectedPattern, $actualPattern);
    }

    /**
     * @dataProvider validYesProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new Yes();

        $this->assertTrue($rule->validate($input));
    }

    public function validYesProvider()
    {
        return [
            ['Y'],
            ['Yea'],
            ['Yeah'],
            ['Yep'],
            ['Yes'],
        ];
    }

    /**
     * @dataProvider invalidYesProvider
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new Yes();

        $this->assertFalse($rule->validate($input));
    }

    public function invalidYesProvider()
    {
        return [
            ['Si'],
            ['Sim'],
            ['Yoo'],
            ['Young'],
            ['Yy'],
        ];
    }
}
