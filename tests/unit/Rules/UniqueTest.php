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
 * @group  rule
 * @covers \Respect\Validation\Rules\Unique
 */
class UniqueTest extends RuleTestCase
{
    public function providerForValidInput(): array
    {
        $rule = new Unique();

        return [
            [$rule, []],
            [$rule, [1, 2, 3]],
            [$rule, [true, false]],
            [$rule, ['alpha', 'beta', 'gamma', 'delta']],
            [$rule, [0, 2.71, 3.14]],
            [$rule, [[], ['str'], [1]]],
            [$rule, [(object) ['key' => 'value'], (object) ['other_key' => 'value']]],
        ];
    }

    public function providerForInvalidInput(): array
    {
        $rule = new Unique();

        return [
            [$rule, 'test'],
            [$rule, [1, 2, 2, 3]],
            [$rule, [1, 2, 3, 1]],
            [$rule, [true, false, false]],
            [$rule, ['alpha', 'beta', 'gamma', 'delta', 'beta']],
            [$rule, [0, 3.14, 2.71, 3.14]],
            [$rule, [[], [1], [1]]],
            [$rule, [(object) ['key' => 'value'], (object) ['key' => 'value']]],
            [$rule, [1, true, 'test']], // PHP's array_unique treats 1 and true as equal
        ];
    }
}
