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
 * @covers \Respect\Validation\Rules\AnyOf
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class AnyOfTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $input = 'foo';

        return [
            [new AnyOf($this->createRuleMock($input, true)), $input],
            [new AnyOf(...$this->createManyRuleMock($input, true, true)), $input],
            [new AnyOf(...$this->createManyRuleMock($input, false, true)), $input],
            [new AnyOf(...$this->createManyRuleMock($input, true, false)), $input],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $input = 'bar';

        return [
            [new AnyOf(), $input],
            [new AnyOf(...$this->createManyRuleMock($input, false)), $input],
            [new AnyOf(...$this->createManyRuleMock($input, false, false)), $input],
        ];
    }

    /**
     * @test
     */
    public function shouldOneRuleResultsAsChildren(): void
    {
        $input = 'baz';

        $expectedRules = $this->createManyRuleMock($input, true, false, true, false);

        $rule = new AnyOf(...$expectedRules);
        $result = $rule->apply($input);

        $actualRules = [];
        foreach ($result->getChildren() as $childResult) {
            $actualRules[] = $childResult->getRule();
        }

        self::assertSame($expectedRules, $actualRules);
    }
}
