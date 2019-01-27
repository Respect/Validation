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
 * @covers \Respect\Validation\Rules\Subset
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Singwai Chan <singwai.chan@live.com>
 */
final class SubsetTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Subset([]), []],
            [new Subset([1]), [1]],
            [new Subset([1, 1]), [1]],
            [new Subset([1]), [1, 1]],
            [new Subset([2, 1, 3]), [1, 2]],
            [new Subset([1, 2, 3]), [1, 2]],
            [new Subset(['a', 1, 2]), [1]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Subset([]), [1]],
            [new Subset([1]), [2]],
            [new Subset([1, 2]), [1, 2, 3]],
            [new Subset(['a', 'b']), ['c']],
        ];
    }
}
