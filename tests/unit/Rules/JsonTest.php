<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Json
 * @covers \Respect\Validation\Exceptions\JsonException
 */
class JsonTest extends RuleTestCase
{
    public function providerForValidInput(): array
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

    public function providerForInvalidInput(): array
    {
        $json = new Json();

        return [
            [$json, false],
            [$json, new \stdClass()],
            [$json, []],
            [$json, ''],
            [$json, 'a'],
            [$json, 'xx'],
            [$json, '{foo: bar}'],
            [$json, '{foo: "baz"}'],
        ];
    }
}
