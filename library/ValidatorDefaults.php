<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\StandardFormatter;
use Respect\Validation\Message\Translator;
use Respect\Validation\Message\Translator\DummyTranslator;

final class ValidatorDefaults
{
    private static ?Factory $factory = null;

    private static ?Formatter $formatter = null;

    private static ?Translator $translator = null;

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

    public static function setFormatter(Formatter $formatter): void
    {
        self::$formatter = $formatter;
    }

    public static function getFormatter(): Formatter
    {
        if (self::$formatter === null) {
            self::$formatter = new StandardFormatter();
        }

        return self::$formatter;
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
}
