<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

use const INF;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\CallableType
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CallableTypeTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new CallableType();

        return [
            [
                $rule,
                static function (): void {
                },
            ],
            [$rule, 'trim'],
            [$rule, self::class . '::staticMethod'],
            [$rule, [$this, __FUNCTION__]],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new CallableType();

        return [
            [$rule, ' '],
            [$rule, INF],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, null],
        ];
    }

    public static function staticMethod(): void
    {
        // This is a static method example
    }
}
