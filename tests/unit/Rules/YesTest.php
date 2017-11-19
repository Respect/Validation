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
 * @covers \Respect\Validation\Rules\Yes
 * @covers \Respect\Validation\Exceptions\YesException
 */
class YesTest extends TestCase
{
    public function testShouldUseDefaultPattern(): void
    {
        $rule = new Yes();

        $actualPattern = $rule->regex;
        $expectedPattern = '/^y(eah?|ep|es)?$/i';

        self::assertEquals($expectedPattern, $actualPattern);
    }

    public function testShouldUseLocalPatternForYesExpressionWhenDefined(): void
    {
        if (!defined('YESEXPR')) {
            $this->markTestSkipped('Constant YESEXPR is not defined');

            return;
        }

        $rule = new Yes(true);

        $actualPattern = $rule->regex;
        $expectedPattern = '/'.nl_langinfo(YESEXPR).'/i';

        self::assertEquals($expectedPattern, $actualPattern);
    }

    /**
     * @dataProvider validYesProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedLocale($input): void
    {
        $rule = new Yes();

        self::assertTrue($rule->validate($input));
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
    public function testShouldNotValidatePatternAccordingToTheDefinedLocale($input): void
    {
        $rule = new Yes();

        self::assertFalse($rule->validate($input));
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
