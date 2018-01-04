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
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Contains
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class ContainsTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Contains('foo'), ['bar', 'foo']],
            [new Contains('foo'), 'barbazFOO'],
            [new Contains('foo'), 'barbazfoo'],
            [new Contains('foo'), 'foobazfoO'],
            [new Contains('1'), [2, 3, 1]],
            [new Contains('1'), [2, 3, '1']],
            [new Contains('foo', true), ['fool', 'foo']],
            [new Contains('foo', true), 'barbazfoo'],
            [new Contains('foo', true), 'foobazfoo'],
            [new Contains('1', true), [2, 3, '1']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Contains('bat'), ['bar', 'foo']],
            [new Contains('foo'), 'barfaabaz'],
            [new Contains('foo'), 'faabarbaz'],
            [new Contains('foo', true), ''],
            [new Contains('bat', true), ['BAT', 'foo']],
            [new Contains('bat', true), ['BaT', 'Batata']],
            [new Contains('foo', true), 'barfaabaz'],
            [new Contains('foo', true), 'barbazFOO'],
            [new Contains('foo', true), 'faabarbaz'],
            [new Contains('1', true), [1, 2, 3]],
        ];
    }

    /**
     * @test
     */
    public function shouldReturnAStringValResultWhenIsNotAString(): void
    {
        $input = new stdClass();

        $rule = new Contains('foo');
        $result = $rule->apply($input);

        $childResult = current($result->getChildren());

        self::assertInstanceOf(StringVal::class, $childResult->getRule());
    }
}
