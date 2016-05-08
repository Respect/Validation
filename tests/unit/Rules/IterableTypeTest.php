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
 * @covers \Respect\Validation\Rules\IterableType
 */
class IterableTypeTest extends RuleTestCase
{
    protected function setUp(): void
    {
        $this->markTestIncomplete(IterableType::class.' needs to be refactored');
    }

    public function providerForValidInput(): array
    {
        $rule = new IterableType();

        return [
            [$rule, [1, 2, 3]],
            [$rule, new \stdClass()],
            [$rule, new \ArrayIterator()],
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
