<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Translator;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[CoversClass(ArrayTranslator::class)]
final class ArrayTranslatorTest extends TestCase
{
    #[Test]
    public function shouldReturnOriginalMessageWhenCannotFindTranslation(): void
    {
        $translator = new ArrayTranslator([]);
        $message = 'This is a test message';

        self::assertSame($message, $translator->translate($message));
    }

    #[Test]
    public function shouldReturnTranslatedMessage(): void
    {
        $messages = ['foo' => 'bar'];

        $translator = new ArrayTranslator($messages);

        self::assertSame($messages['foo'], $translator->translate('foo'));
    }

    #[Test]
    public function shouldReturnOriginalMessageWhenTranslationIsNotString(): void
    {
        $messages = ['foo' => 123];

        $translator = new ArrayTranslator($messages);

        self::assertSame('foo', $translator->translate('foo'));
    }
}
