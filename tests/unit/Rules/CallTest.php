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
 * @covers \Respect\Validation\Rules\Call
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class CallTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Call('trim', $this->createRuleMock('Something', true)), ' Something '],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Call('trim', $this->createRuleMock('Something', false)), ' Something '],
        ];
    }

    /**
     * @test
     */
    public function shouldValidateTheReturnOfTheCallable(): void
    {
        $input = 'Something';
        $return = str_split($input);

        $childRule = $this->createRuleMock($return, true);

        $rule = new Call('str_split', $childRule, $input);
        $result = $rule->apply($input);

        $childResult = current($result->getChildren());

        self::assertSame($return, $childResult->getInput());
    }
}
