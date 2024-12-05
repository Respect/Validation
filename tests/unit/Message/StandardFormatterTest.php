<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\StandardFormatter\ArrayProvider;
use Respect\Validation\Message\StandardFormatter\FullProvider;
use Respect\Validation\Message\StandardFormatter\MainProvider;
use Respect\Validation\Message\Translator\DummyTranslator;
use Respect\Validation\Result;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingMessageRenderer;
use Respect\Validation\Test\TestCase;
use stdClass;

use function Respect\Stringifier\stringify;
use function sprintf;

#[CoversClass(StandardFormatter::class)]
final class StandardFormatterTest extends TestCase
{
    use ArrayProvider;
    use FullProvider;
    use MainProvider;

    /** @param array<string, mixed> $templates */
    #[Test]
    #[DataProvider('provideForMain')]
    public function itShouldFormatMainMessage(Result $result, string $expected, array $templates = []): void
    {
        $renderer = new StandardFormatter(new TestingMessageRenderer());

        self::assertSame($expected, $renderer->main($result, $templates, new DummyTranslator()));
    }

    #[Test]
    public function itShouldThrowAnExceptionWhenTryingToFormatAsMainAndTemplateIsInvalid(): void
    {
        $renderer = new StandardFormatter(new TestingMessageRenderer());
        $result = (new ResultBuilder())->id('foo')->build();

        $template = new stdClass();

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage(sprintf('Template for "foo" must be a string, %s given', stringify($template)));

        $renderer->main($result, ['foo' => $template], new DummyTranslator());
    }

    /** @param array<string, mixed> $templates */
    #[Test]
    #[DataProvider('provideForFull')]
    public function itShouldFormatFullMessage(Result $result, string $expected, array $templates = []): void
    {
        $renderer = new StandardFormatter(new TestingMessageRenderer());

        self::assertSame($expected, $renderer->full($result, $templates, new DummyTranslator()));
    }

    #[Test]
    public function itShouldThrowAnExceptionWhenTryingToFormatAsFullAndTemplateIsInvalid(): void
    {
        $renderer = new StandardFormatter(new TestingMessageRenderer());
        $result = (new ResultBuilder())->id('foo')->build();

        $template = new stdClass();

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage(sprintf('Template for "foo" must be a string, %s given', stringify($template)));

        $renderer->full($result, ['foo' => $template], new DummyTranslator());
    }

    /**
     * @param array<string, mixed> $expected
     * @param array<string, mixed> $templates
     */
    #[Test]
    #[DataProvider('provideForArray')]
    public function itShouldFormatArrayMessage(Result $result, array $expected, array $templates = []): void
    {
        $renderer = new StandardFormatter(new TestingMessageRenderer());

        self::assertSame($expected, $renderer->array($result, $templates, new DummyTranslator()));
    }

    #[Test]
    public function itShouldThrowAnExceptionWhenTryingToFormatAsArrayAndTemplateIsInvalid(): void
    {
        $renderer = new StandardFormatter(new TestingMessageRenderer());
        $result = (new ResultBuilder())->id('foo')->build();

        $template = new stdClass();

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage(sprintf('Template for "foo" must be a string, %s given', stringify($template)));

        $renderer->array($result, ['foo' => $template], new DummyTranslator());
    }
}
