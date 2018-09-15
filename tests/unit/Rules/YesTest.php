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

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Yes
 *
 * @author Cameron Hall <me@chall.id.au>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class YesTest extends RuleTestCase
{
    /**
     * @test
     */
    public function shouldUseDefaultPattern(): void
    {
        $rule = new Yes();

        $actualPattern = $rule->regex;
        $expectedPattern = '/^y(eah?|ep|es)?$/i';

        self::assertEquals($expectedPattern, $actualPattern);
    }

    /**
     * @test
     */
    public function shouldUseLocalPatternForYesExpressionWhenDefined(): void
    {
        if (!defined('YESEXPR')) {
            self::markTestSkipped('Constant YESEXPR is not defined');

            return;
        }

        $rule = new Yes(true);

        $actualPattern = $rule->regex;
        $expectedPattern = '/'.nl_langinfo(YESEXPR).'/i';

        self::assertEquals($expectedPattern, $actualPattern);
    }

    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $yes = new Yes();

        return [
            [$yes, 'Y'],
            [$yes, 'Yea'],
            [$yes, 'Yeah'],
            [$yes, 'Yep'],
            [$yes, 'Yes'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $yes = new Yes();

        return [
            [$yes, 'Si'],
            [$yes, 'Sim'],
            [$yes, 'Yoo'],
            [$yes, 'Young'],
            [$yes, 'Yy'],
        ];
    }
}
