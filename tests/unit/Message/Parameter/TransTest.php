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

#[CoversClass(Trans::class)]
final class TransTest extends TestCase
{
    public const DEFAULT_NAME = 'foo';

    #[Test]
    #[DataProvider('providerForStringValues')]
    public function itShouldReturnTranslatedValueWhenModifierIsTransAndInputIsString(string $value): void
    {
        $translation = 'translated';
        $translator = static fn(string $original) => [$value => $translation][$original] ?? 'Failed to translate';

        $trans = new Trans($translator, new TestingProcessor());

        self::assertEquals($translation, $trans->process(self::DEFAULT_NAME, $value, 'trans'));
    }

    #[Test]
    #[DataProvider('providerForNonStringValues')]
    public function itShouldUseNextProcessorWhenModifierIsTransButInputIsNotString(mixed $value): void
    {
        $next = new TestingProcessor();
        $trans = new Trans(static fn($original) => $original, $next);

        self::assertEquals(
            $next->process(self::DEFAULT_NAME, $value, 'trans'),
            $trans->process(self::DEFAULT_NAME, $value, 'trans')
        );
    }

    #[Test]
    #[DataProvider('providerForScalarValues')]
    public function itShouldUseNextProcessorWhenModifierInputIsStringButModifierIsNotTrans(mixed $value): void
    {
        $next = new TestingProcessor();

        $trans = new Trans(static fn($original) => $original, $next);

        self::assertEquals(
            $next->process(self::DEFAULT_NAME, $value, 'something'),
            $trans->process(self::DEFAULT_NAME, $value, 'something')
        );
    }
}
