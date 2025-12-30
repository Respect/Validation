<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\Message\NullStringifier;
use Respect\Validation\Test\Message\TestingStringifier;
use Respect\Validation\Test\TestCase;

use function print_r;
use function sprintf;

#[CoversClass(StringifyModifier::class)]
final class StringifyModifierTest extends TestCase
{
    #[Test]
    public function itShouldUseStringifierWhenAvailable(): void
    {
        $value = ['some', 'array'];

        $stringifier = new TestingStringifier();
        $modifier = new StringifyModifier($stringifier);

        $expected = $stringifier->stringify($value, 0);

        self::assertSame($expected, $modifier->modify($value, null));
    }

    #[Test]
    public function itShouldUseFallbackWhenStringifierIsNull(): void
    {
        $value = ['some', 'array'];
        $expected = print_r($value, true);

        $modifier = new StringifyModifier(new NullStringifier());

        self::assertSame($expected, $modifier->modify($value, null));
    }

    #[Test]
    public function itShouldFailWhenPipeParameterIsGiven(): void
    {
        $pipe = 'someModifier';

        $modifier = new StringifyModifier(new TestingStringifier());

        $this->expectExceptionObject(new ComponentException(sprintf(
            'StringifyModifier only accepts null as  pipe but "%s" was given.',
            $pipe,
        )));

        $modifier->modify(['some', 'array'], $pipe);
    }
}
