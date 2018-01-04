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
 * @covers \Respect\Validation\Rules\NoneOf
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class NoneOfTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $input = 'foo';

        return [
            [new NoneOf(), $input],
            [new NoneOf($this->createRuleMock($input, false)), $input],
            [new NoneOf(...$this->createManyRuleMock($input, false, false)), $input],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $input = 'bar';

        return [
            [new NoneOf($this->createRuleMock($input, true)), $input],
            [new NoneOf(...$this->createManyRuleMock($input, true, false)), $input],
            [new NoneOf(...$this->createManyRuleMock($input, false, true)), $input],
            [new NoneOf(...$this->createManyRuleMock($input, true, true)), $input],
        ];
    }

    /**
     * @test
     */
    public function shouldAllRuleResultsAsChildren(): void
    {
        $input = 'baz';

        $expectedRules = $this->createManyRuleMock($input, true, false, true, false);

        $rule = new NoneOf(...$expectedRules);
        $result = $rule->apply($input);

        $actualRules = [];
        foreach ($result->getChildren() as $childResult) {
            $actualRules[] = $childResult->getRule();
        }

        self::assertSame($expectedRules, $actualRules);
    }

    /**
     * @test
     */
    public function shouldInvertValidResultChildren(): void
    {
        $input = 'baz';

        $expectedRules = $this->createManyRuleMock($input, false, false);

        $rule = new NoneOf(...$expectedRules);
        $result = $rule->apply($input);

        $isInverted = true;
        foreach ($result->getChildren() as $childRule) {
            $isInverted = $isInverted && $childRule->isInverted();
        }

        self::assertTrue($isInverted);
    }
}
