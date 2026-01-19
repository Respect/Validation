<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\Placeholder\Listed;
use Respect\Validation\Message\Translator\ArrayTranslator;
use Respect\Validation\Test\Message\TestingModifier;
use Respect\Validation\Test\TestCase;

#[CoversClass(ListOrModifier::class)]
final class ListOrModifierTest extends TestCase
{
    #[Test]
    public function itShouldNotModifyWhenModifierIsNotListOr(): void
    {
        $translator = new ArrayTranslator(['or' => 'or']);
        $nextModifier = new TestingModifier();
        $modifier = new ListOrModifier($translator, $nextModifier);

        $value = ['item1', 'item2'];
        $pipe = 'listAnd';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($nextModifier->modify($value, $pipe), $result);
    }

    #[Test]
    public function itShouldNotModifyWhenValueIsNotArray(): void
    {
        $translator = new ArrayTranslator(['or' => 'or']);
        $nextModifier = new TestingModifier();
        $modifier = new ListOrModifier($translator, $nextModifier);

        $value = 'not an array';
        $pipe = 'listOr';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($nextModifier->modify($value, $pipe), $result);
    }

    #[Test]
    public function itShouldModifyWhenModifierIsListOrAndValueIsArray(): void
    {
        $translator = new ArrayTranslator(['or' => 'or']);
        $nextModifier = new TestingModifier();
        $modifier = new ListOrModifier($translator, $nextModifier);

        $value = ['item1', 'item2', 'item3'];
        $pipe = 'listOr';

        $result = $modifier->modify($value, $pipe);

        $expectedValue = new Listed($value, $translator->translate('or'));
        $expected = $nextModifier->modify($expectedValue, null);

        self::assertSame($expected, $result);
    }
}
