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
 * @covers Respect\Validation\Rules\Call
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class CallTest extends RuleTestCase2
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Call('trim', $this->createRuleMock(true, 'Something')), ' Something '],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Call('trim', $this->createRuleMock(false, 'Something')), ' Something '],
        ];
    }

    /**
     * @test
     */
    public function shouldValidateTheReturnOfTheCallable()
    {
        $input = 'Something';
        $return = str_split($input);

        $childRule = $this->createRuleMock(true, $return);

        $rule = new Call('str_split', $childRule, $input);
        $result = $rule->validate($input);

        $childResult = current($result->getChildren());

        $this->assertSame($return, $childResult->getInput());
    }
}
