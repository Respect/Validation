<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Formatter\FirstResultStringFormatter;
use Respect\Validation\Message\Formatter\NestedArrayFormatter;
use Respect\Validation\Message\Formatter\NestedListStringFormatter;
use Respect\Validation\Message\Formatter\TemplateResolver;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StandardRenderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Message\Translator;
use Respect\Validation\Message\Translator\DummyTranslator;

final class ValidatorDefaults
{
    private static Factory|null $factory = null;

    private static Renderer|null $renderer = null;

    private static StringFormatter|null $mainMessageFormatter = null;

    private static StringFormatter|null $fullMessageFormatter = null;

    private static ArrayFormatter|null $messagesFormatter = null;

    private static Translator|null $translator = null;

    private static TemplateResolver|null $templateResolver = null;

    /** @var array<string> */
    private static array $ignoredBacktracePaths = [__DIR__ . '/Validator.php'];

    public static function setFactory(Factory $factory): void
    {
        self::$factory = $factory;
    }

    public static function getFactory(): Factory
    {
        if (self::$factory === null) {
            self::$factory = new Factory();
        }

        return self::$factory;
    }

    public static function setRenderer(Renderer $renderer): void
    {
        self::$renderer = $renderer;
    }

    public static function getRenderer(): Renderer
    {
        if (self::$renderer === null) {
            self::$renderer = new StandardRenderer();
        }

        return self::$renderer;
    }

    public static function setMainMessageFormatter(StringFormatter $mainMessageFormatter): void
    {
        self::$mainMessageFormatter = $mainMessageFormatter;
    }

    public static function getMainMessageFormatter(): StringFormatter
    {
        if (self::$mainMessageFormatter === null) {
            self::$mainMessageFormatter = new FirstResultStringFormatter(
                self::getRenderer(),
                self::getTemplateResolver(),
            );
        }

        return self::$mainMessageFormatter;
    }

    public static function setFullMessageFormatter(StringFormatter|null $fullMessageFormatter): void
    {
        self::$fullMessageFormatter = $fullMessageFormatter;
    }

    public static function getFullMessageFormatter(): StringFormatter
    {
        if (self::$fullMessageFormatter === null) {
            self::$fullMessageFormatter = new NestedListStringFormatter(
                self::getRenderer(),
                self::getTemplateResolver(),
            );
        }

        return self::$fullMessageFormatter;
    }

    public static function setMessagesFormatter(ArrayFormatter $messagesFormatter): void
    {
        self::$messagesFormatter = $messagesFormatter;
    }

    public static function getMessagesFormatter(): ArrayFormatter
    {
        if (self::$messagesFormatter === null) {
            self::$messagesFormatter = new NestedArrayFormatter(
                self::getRenderer(),
                self::getTemplateResolver(),
            );
        }

        return self::$messagesFormatter;
    }

    public static function setTranslator(Translator $translator): void
    {
        self::$translator = $translator;
    }

    public static function getTranslator(): Translator
    {
        if (self::$translator === null) {
            self::$translator = new DummyTranslator();
        }

        return self::$translator;
    }

    /** @return array<string>*/
    public static function getIgnoredBacktracePaths(): array
    {
        return self::$ignoredBacktracePaths;
    }

    public static function setIgnoredBacktracePaths(string ...$ignoredBacktracePaths): void
    {
        self::$ignoredBacktracePaths = $ignoredBacktracePaths;
    }

    private static function getTemplateResolver(): TemplateResolver
    {
        if (self::$templateResolver === null) {
            self::$templateResolver = new TemplateResolver();
        }

        return self::$templateResolver;
    }
}
