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

use ArrayIterator;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\IterableType
 *
 * @author Guilherme Siani <guilherme@siani.com.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IterableTypeTest extends RuleTestCase
{
    public function providerForValidInput(): array
    {
        $rule = new IterableType();

        return [
            [$rule, [1, 2, 3]],
            [$rule, new stdClass()],
            [$rule, new ArrayIterator()],
        ];
    }

    public function providerForInvalidInput(): array
    {
        $rule = new IterableType();

        return [
            [$rule, 3],
            [$rule, 'asdf'],
            [$rule, 9.85],
            [$rule, null],
            [$rule, true],
        ];
    }
}
