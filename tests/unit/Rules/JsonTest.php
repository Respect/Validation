<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\Json
 */
final class JsonTest extends RuleTestCase
{
    /**
     * @return array<array{Json, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $json = new Json();

        return [
            [$json, '2'],
            [$json, '"abc"'],
            [$json, '[1,2,3]'],
            [$json, '["foo", "bar", "number", 1]'],
            [$json, '{"foo": "bar", "number":1}'],
            [$json, '[]'],
            [$json, '{}'],
            [$json, 'false'],
            [$json, 'null'],
        ];
    }

    /**
     * @return array<array{Json, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $json = new Json();

        return [
            [$json, false],
            [$json, new stdClass()],
            [$json, []],
            [$json, ''],
            [$json, 'a'],
            [$json, 'xx'],
            [$json, '{foo: bar}'],
            [$json, '{foo: "baz"}'],
        ];
    }
}
