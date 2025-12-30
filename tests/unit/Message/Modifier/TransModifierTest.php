<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\Translator\ArrayTranslator;
use Respect\Validation\Test\Message\TestingModifier;
use Respect\Validation\Test\TestCase;

#[CoversClass(TransModifier::class)]
final class TransModifierTest extends TestCase
{
    #[Test]
    public function itShouldNotModifyWhenModifierIsNotTrans(): void
    {
        $translator = new ArrayTranslator(['message' => 'translated message']);
        $nextModifier = new TestingModifier();
        $modifier = new TransModifier($translator, $nextModifier);

        $value = 'message';
        $pipe = 'notTrans';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($nextModifier->modify($value, $pipe), $result);
    }

    #[Test]
    public function itShouldNotModifyWhenValueIsNotString(): void
    {
        $translator = new ArrayTranslator(['message' => 'translated message']);
        $nextModifier = new TestingModifier();
        $modifier = new TransModifier($translator, $nextModifier);

        $value = ['not', 'a', 'string'];
        $pipe = 'trans';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($nextModifier->modify($value, $pipe), $result);
    }

    #[Test]
    public function itShouldModifyWhenModifierIsTransAndValueIsString(): void
    {
        $key = 'message';
        $translatedMessage = 'translated message';
        $translator = new ArrayTranslator([$key => $translatedMessage]);
        $nextModifier = new TestingModifier();
        $modifier = new TransModifier($translator, $nextModifier);

        $value = $key;
        $pipe = 'trans';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($translatedMessage, $result);
    }

    #[Test]
    public function itShouldReturnKeyWhenTranslationNotFound(): void
    {
        $key = 'nonexistent';
        $translator = new ArrayTranslator(['message' => 'translated message']);
        $nextModifier = new TestingModifier();
        $modifier = new TransModifier($translator, $nextModifier);

        $value = $key;
        $pipe = 'trans';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($key, $result);
    }
}
