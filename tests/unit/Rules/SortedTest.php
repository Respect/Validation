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
 * @group rules
 *
 * @covers \Respect\Validation\Rules\Sorted
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Mikhail Vyrtsev <reeywhaar@gmail.com>
 */
final class SortedTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $fn = static function ($x) {
            return $x['key'];
        };

        return [
            [new Sorted(), [1]],
            [new Sorted(), [1, 2, 3]],
            [new Sorted(), [1, 2, 2, 3]],
            [new Sorted(null, false), [10, 9, 8]],
            [new Sorted(null, false), [10, 9, 9, 8]],
            [new Sorted($fn, true), [['key' => 1, ], ['key' => 2, ], ['key' => 5]]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $fn = static function ($x) {
            return $x['key'];
        };

        return [
            [new Sorted(), [1, 2, 4, 3]],
            [new Sorted(), [1, 2, 4, 4, 3]],
            [new Sorted($fn), [['key' => 1], ['key' => 8], ['key' => 5]]],
        ];
    }
}
