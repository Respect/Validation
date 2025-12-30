<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\Placeholder\Listed;
use Respect\Validation\Message\Translator\ArrayTranslator;
use Respect\Validation\Test\Message\TestingModifier;
use Respect\Validation\Test\TestCase;

#[CoversClass(ListAndModifier::class)]
final class ListAndModifierTest extends TestCase
{
    #[Test]
    public function itShouldNotModifyWhenModifierIsNotListAnd(): void
    {
        $translator = new ArrayTranslator(['and' => 'and']);
        $nextModifier = new TestingModifier();
        $modifier = new ListAndModifier($translator, $nextModifier);

        $value = ['item1', 'item2'];
        $pipe = 'listOr';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($nextModifier->modify($value, $pipe), $result);
    }

    #[Test]
    public function itShouldNotModifyWhenValueIsNotArray(): void
    {
        $translator = new ArrayTranslator(['and' => 'and']);
        $nextModifier = new TestingModifier();
        $modifier = new ListAndModifier($translator, $nextModifier);

        $value = 'not an array';
        $pipe = 'listAnd';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($nextModifier->modify($value, $pipe), $result);
    }

    #[Test]
    public function itShouldModifyWhenModifierIsListAndAndValueIsArray(): void
    {
        $translator = new ArrayTranslator(['and' => 'and']);
        $nextModifier = new TestingModifier();
        $modifier = new ListAndModifier($translator, $nextModifier);

        $value = ['item1', 'item2', 'item3'];
        $pipe = 'listAnd';

        $result = $modifier->modify($value, $pipe);

        $expectedValue = new Listed($value, $translator->translate('and'));
        $expected = $nextModifier->modify($expectedValue, null);

        self::assertSame($expected, $result);
    }
}
