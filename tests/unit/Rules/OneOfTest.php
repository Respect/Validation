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
 * @covers \Respect\Validation\Rules\OneOf
 *
 * @author Bradyn Poulsen <bradyn@bradynpoulsen.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 2.0.0
 */
final class OneOfTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $input = 'foo';

        return [
            [new OneOf($this->createRuleMock($input, true)), $input],
            [new OneOf(...$this->createManyRuleMock($input, true, false)), $input],
            [new OneOf(...$this->createManyRuleMock($input, false, true)), $input],
            [new OneOf(...$this->createManyRuleMock($input, false, false, true)), $input],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $input = 'bar';

        return [
            [new OneOf(), $input],
            [new OneOf($this->createRuleMock($input, false)), $input],
            [new OneOf(...$this->createManyRuleMock($input, false, false)), $input],
            [new OneOf(...$this->createManyRuleMock($input, true, true)), $input],
            [new OneOf(...$this->createManyRuleMock($input, false, true, true)), $input],
        ];
    }

    /**
     * @test
     */
    public function shouldOneRuleResultsAsChildren(): void
    {
        $input = 'baz';

        $expectedRules = $this->createManyRuleMock($input, true, false, true, false);

        $rule = new OneOf(...$expectedRules);
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
    public function shouldInvertValidResultsWhenThereIsAlreadyAValidResult(): void
    {
        $input = 'baz';

        $expectedRules = $this->createManyRuleMock($input, true, true);

        $rule = new OneOf(...$expectedRules);
        $result = $rule->apply($input);

        $childrenResult = $result->getChildren();
        $lastResult = array_pop($childrenResult);

        self::assertTrue($lastResult->isInverted());
    }
}
