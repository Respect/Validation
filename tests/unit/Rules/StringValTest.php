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
use stdClass;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\StringVal
 */
class StringValTest extends RuleTestCase
{
    public function providerForValidInput(): array
    {
        $rule = new StringVal();

        return [
            [$rule, '6'],
            [$rule, 'String'],
            [$rule, 1.0],
            [$rule, 42],
            [$rule, false],
            [$rule, true],
            [$rule, new ClassWithToString()],
        ];
    }

    public function providerForInvalidInput(): array
    {
        $rule = new StringVal();

        return [
            [$rule, []],
            [$rule, function (): void {
            }],
            [$rule, new stdClass()],
            [$rule, null],
            [$rule, tmpfile()],
        ];
    }
}

class ClassWithToString
{
    public function __toString()
    {
        return self::class;
    }
}
