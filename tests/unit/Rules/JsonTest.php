<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Json
 * @covers Respect\Validation\Exceptions\JsonException
 */
class JsonTest extends RuleTestCase
{
    /**
     * @dataProvider providerForValidInput
     */
    public function testValidJsonsShouldReturnTrue($json, $input)
    {
        $this->assertTrue($json->__invoke($input));
        $this->assertTrue($json->check($input));
        $this->assertTrue($json->assert($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\JSonException
     */
    public function testInvalidJsonsShouldThrowJsonException()
    {
        $json = new Json();

        $this->assertFalse($json->__invoke('{foo:bar}'));
        $this->assertFalse($json->assert('{foo:bar}'));
    }

    public function providerForValidInput()
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
            [$json, ''],
        ];
    }

    public function providerForInvalidInput()
    {
        $json = new Json();

        return [
            [$json, 'a'],
            [$json, 'xx'],
            [$json, '{foo: bar}'],
            [$json, '{foo: "baz"}'],
        ];
    }
}
