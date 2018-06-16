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
 * @covers \Respect\Validation\Rules\Each
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class EachTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $ruleNotEmpty = new Each($this->createValidatableMock(true));
        $ruleAlphaItemIntKey = new Each($this->createValidatableMock(true), $this->createValidatableMock(true));
        $ruleOnlyKeyValidation = new Each(null, $this->createValidatableMock(true));

        $intStack = new \SplStack();
        $intStack->push(1);
        $intStack->push(2);
        $intStack->push(3);
        $intStack->push(4);
        $intStack->push(5);

        $stdClass = new \stdClass();
        $stdClass->name = 'Emmerson';
        $stdClass->age = 22;

        return [
            [$ruleNotEmpty, [1, 2, 3, 4, 5]],
            [$ruleNotEmpty, $intStack],
            [$ruleNotEmpty, $stdClass],
            [$ruleAlphaItemIntKey, ['a', 'b', 'c', 'd', 'e']],
            [$ruleOnlyKeyValidation, ['a', 'b', 'c', 'd', 'e']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Each($this->createValidatableMock(false));
        $ruleOnlyKeyValidation = new Each(null, $this->createValidatableMock(false));

        return [
            [$rule, 123],
            [$rule, ''],
            [$rule, null],
            [$rule, false],
            [$rule, ['', 2, 3, 4, 5]],
            [$rule, ['a', 2, 3, 4, 5]],
            [$ruleOnlyKeyValidation, ['age' => 22]],
            [$ruleOnlyKeyValidation, ['a', 'b', 'c', 'd', 'e']],
        ];
    }
}
