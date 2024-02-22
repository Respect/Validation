<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Parameter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Message\Parameter\TestingProcessor;
use Respect\Validation\Test\TestCase;

#[CoversClass(Raw::class)]
final class RawTest extends TestCase
{
    public const DEFAULT_NAME = 'foo';

    #[Test]
    #[DataProvider('providerForScalarValues')]
    public function itShouldReturnRawValueWhenModifierIsRawAndInputIsScalar(mixed $value): void
    {
        $raw = new Raw(new TestingProcessor());

        self::assertEquals($value, $raw->process(self::DEFAULT_NAME, $value, 'raw'));
    }

    #[Test]
    public function itShouldReturnRawZeroWhenModifierIsRawAndInputIsFalse(): void
    {
        $raw = new Raw(new TestingProcessor());

        self::assertSame('0', $raw->process(self::DEFAULT_NAME, false, 'raw'));
    }

    #[Test]
    #[DataProvider('providerForNonScalarValues')]
    public function itShouldUseNextProcessorWhenModifierIsRawButInputIsNonScalar(mixed $value): void
    {
        $next = new TestingProcessor();
        $raw = new Raw($next);

        self::assertEquals(
            $next->process(self::DEFAULT_NAME, $value, 'raw'),
            $raw->process(self::DEFAULT_NAME, $value, 'raw')
        );
    }

    #[Test]
    #[DataProvider('providerForScalarValues')]
    public function itShouldUseNextProcessorWhenModifierInputIsScalarButModifierIsNotRaw(mixed $value): void
    {
        $next = new TestingProcessor();
        $raw = new Raw($next);

        self::assertEquals(
            $next->process(self::DEFAULT_NAME, $value, 'something'),
            $raw->process(self::DEFAULT_NAME, $value, 'something')
        );
    }
}
