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
 * @covers \Respect\Validation\Rules\NumericVal
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class NumericValTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new NumericVal();

        return [
            [$rule, 165],
            [$rule, 165.0],
            [$rule, -165],
            [$rule, '165'],
            [$rule, '165.0'],
            [$rule, '+165.0'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new NumericVal();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 'a'],
            [$rule, ' '],
            [$rule, 'Foo'],
        ];
    }
}
