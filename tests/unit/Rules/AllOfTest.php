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
 * @covers \Respect\Validation\Rules\AllOf
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class AllOfTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $input = 'foo';

        return [
            [new AllOf($this->createRuleMock($input, true)), $input],
            [new AllOf(...$this->createManyRuleMock($input, true, true)), $input],
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
            [new AllOf($this->createRuleMock($input, false)), $input],
            [new AllOf(...$this->createManyRuleMock($input, false, true)), $input],
            [new AllOf(...$this->createManyRuleMock($input, true, false)), $input],
            [new AllOf(...$this->createManyRuleMock($input, false, false)), $input],
        ];
    }

    /**
     * @test
     */
    public function shouldAllRuleResultsAsChildren(): void
    {
        $input = 'baz';

        $expectedRules = $this->createManyRuleMock($input, true, false, true, false);

        $rule = new AllOf(...$expectedRules);
        $result = $rule->apply($input);

        $actualRules = [];
        foreach ($result->getChildren() as $childResult) {
            $actualRules[] = $childResult->getRule();
        }

        self::assertSame($expectedRules, $actualRules);
    }
}
