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

/**
 * @group rule
 *
 * @covers Respect\Validation\Rules\AllOf
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class AllOfTest extends RuleTestCase2
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $input = 'foo';

        return [
            [new AllOf($this->createRuleMock(true, $input)), $input],
            [new AllOf($this->createRuleMock(true, $input), $this->createRuleMock(true, $input)), $input],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $input = 'bar';

        return [
            [new AllOf(), $input],
            [new AllOf($this->createRuleMock(false, $input)), $input],
            [new AllOf($this->createRuleMock(false, $input), $this->createRuleMock(true, $input)), $input],
            [new AllOf($this->createRuleMock(true, $input), $this->createRuleMock(false, $input)), $input],
            [new AllOf($this->createRuleMock(false, $input), $this->createRuleMock(false, $input)), $input],
        ];
    }

    /**
     * @test
     */
    public function shouldAllRuleResultsAsChildren()
    {
        $input = 'baz';

        $expectedRules = [
            $this->createRuleMock(true, $input),
            $this->createRuleMock(false, $input),
            $this->createRuleMock(true, $input),
            $this->createRuleMock(false, $input),
        ];

        $rule = new AllOf(...$expectedRules);
        $result = $rule->validate($input);

        $actualRules = [];
        foreach ($result->getChildren() as $childResult) {
            $actualRules[] = $childResult->getRule();
        }

        $this->assertSame($expectedRules, $actualRules);
    }
}
