<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Formatter\FirstResultStringFormatter;
use Respect\Validation\Message\Formatter\NestedArrayFormatter;
use Respect\Validation\Message\Formatter\NestedListStringFormatter;
use Respect\Validation\Message\InterpolationRenderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Message\Translator;
use Respect\Validation\Message\Translator\DummyTranslator;
use Respect\Validation\Test\Message\TestingMessageRenderer;
use Respect\Validation\Test\TestCase;

#[CoversClass(ValidatorDefaults::class)]
final class ValidatorDefaultsTest extends TestCase
{
    private Message\Renderer $defaultRenderer;

    private Factory $defaultFactory;

    private StringFormatter $defaultMainMessageFormatter;

    private StringFormatter $defaultFullMessageFormatter;

    private ArrayFormatter $defaultMessagesFormatter;

    private Translator $defaultTranslator;

    /** @var string[] */
    private array $defaultIgnoredBacktracePaths;

    protected function setUp(): void
    {
        $this->defaultRenderer = ValidatorDefaults::getRenderer();
        $this->defaultFactory = ValidatorDefaults::getFactory();
        $this->defaultMainMessageFormatter = ValidatorDefaults::getMainMessageFormatter();
        $this->defaultFullMessageFormatter = ValidatorDefaults::getFullMessageFormatter();
        $this->defaultMessagesFormatter = ValidatorDefaults::getMessagesFormatter();
        $this->defaultTranslator = ValidatorDefaults::getTranslator();
        $this->defaultIgnoredBacktracePaths = ValidatorDefaults::getIgnoredBacktracePaths();
    }

    #[Test]
    public function defaultFactoryIsCreatedOnce(): void
    {
        $first = ValidatorDefaults::getFactory();
        $second = ValidatorDefaults::getFactory();

        self::assertSame($first, $second);
    }

    #[Test]
    public function setFactoryOverridesDefault(): void
    {
        $custom = new Factory();
        ValidatorDefaults::setFactory($custom);

        self::assertSame($custom, ValidatorDefaults::getFactory());
    }

    #[Test]
    public function defaultRendererIsCreatedOnce(): void
    {
        $first = ValidatorDefaults::getRenderer();
        $second = ValidatorDefaults::getRenderer();

        self::assertInstanceOf(InterpolationRenderer::class, $first);
        self::assertSame($first, $second);
    }

    #[Test]
    public function setRendererOverridesDefault(): void
    {
        $renderer = new TestingMessageRenderer();
        ValidatorDefaults::setRenderer($renderer);

        self::assertSame($renderer, ValidatorDefaults::getRenderer());
    }

    #[Test]
    public function defaultMainMessageFormatterIsCreatedOnce(): void
    {
        $first = ValidatorDefaults::getMainMessageFormatter();
        $second = ValidatorDefaults::getMainMessageFormatter();

        self::assertInstanceOf(FirstResultStringFormatter::class, $first);
        self::assertSame($first, $second);
    }

    #[Test]
    public function setMainMessageFormatterOverridesDefault(): void
    {
        $mainMessageFormatter = $this->createStringFormatter();
        ValidatorDefaults::setMainMessageFormatter($mainMessageFormatter);

        self::assertSame($mainMessageFormatter, ValidatorDefaults::getMainMessageFormatter());
    }

    #[Test]
    public function defaultFullMessageFormatterIsCreatedOnce(): void
    {
        $first = ValidatorDefaults::getFullMessageFormatter();
        $second = ValidatorDefaults::getFullMessageFormatter();

        self::assertInstanceOf(NestedListStringFormatter::class, $first);
        self::assertSame($first, $second);
    }

    #[Test]
    public function setFullMessageFormatterOverridesDefault(): void
    {
        $fullMessageFormatter = $this->createStringFormatter();
        ValidatorDefaults::setFullMessageFormatter($fullMessageFormatter);

        self::assertSame($fullMessageFormatter, ValidatorDefaults::getFullMessageFormatter());
    }

    #[Test]
    public function defaultMessagesFormatterIsCreatedOnce(): void
    {
        $first = ValidatorDefaults::getMessagesFormatter();
        $second = ValidatorDefaults::getMessagesFormatter();

        self::assertInstanceOf(NestedArrayFormatter::class, $first);
        self::assertSame($first, $second);
    }

    #[Test]
    public function setMessagesFormatterOverridesDefault(): void
    {
        $arrayFormatter = $this->createArrayFormatter();
        ValidatorDefaults::setMessagesFormatter($arrayFormatter);

        self::assertSame($arrayFormatter, ValidatorDefaults::getMessagesFormatter());
    }

    #[Test]
    public function defaultTranslatorIsCreatedOnce(): void
    {
        $first = ValidatorDefaults::getTranslator();
        $second = ValidatorDefaults::getTranslator();

        self::assertInstanceOf(DummyTranslator::class, $first);
        self::assertSame($first, $second);
    }

    #[Test]
    public function setTranslatorOverridesDefault(): void
    {
        $custom = $this->createTranslator();
        ValidatorDefaults::setTranslator($custom);

        self::assertSame($custom, ValidatorDefaults::getTranslator());
    }

    #[Test]
    public function ignoredBacktracePathsCanBeRetrievedAndOverridden(): void
    {
        $default = ValidatorDefaults::getIgnoredBacktracePaths();
        self::assertIsArray($default);
        self::assertNotEmpty($default);

        ValidatorDefaults::setIgnoredBacktracePaths('foo.php', 'bar.php');
        $new = ValidatorDefaults::getIgnoredBacktracePaths();
        self::assertSame(['foo.php', 'bar.php'], $new);
    }

    public function createStringFormatter(): StringFormatter
    {
        return new class implements StringFormatter {
            /** @param array<string, mixed> $templates */
            public function format(Result $result, array $templates, Translator $translator): string
            {
                return 'custom';
            }
        };
    }

    public function createArrayFormatter(): ArrayFormatter
    {
        return new class implements ArrayFormatter {
            /**
             * @param array<string, mixed> $templates
             *
             * @return array<string, mixed>
             */
            public function format(Result $result, array $templates, Translator $translator): array
            {
                return [];
            }
        };
    }

    public function createTranslator(): Translator
    {
        return new class implements Translator {
            public function translate(string $message): string
            {
                return $message;
            }
        };
    }

    protected function tearDown(): void
    {
        ValidatorDefaults::setRenderer($this->defaultRenderer);
        ValidatorDefaults::setFactory($this->defaultFactory);
        ValidatorDefaults::setMainMessageFormatter($this->defaultMainMessageFormatter);
        ValidatorDefaults::setFullMessageFormatter($this->defaultFullMessageFormatter);
        ValidatorDefaults::setMessagesFormatter($this->defaultMessagesFormatter);
        ValidatorDefaults::setTranslator($this->defaultTranslator);
        ValidatorDefaults::setIgnoredBacktracePaths(...$this->defaultIgnoredBacktracePaths);
    }
}
