<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Exceptions;

use ArrayIterator;
use DateTime;
use Exception;
use Respect\Validation\TestCase;
use SplFileInfo;
use stdClass;

class ValidationExceptionTest extends TestCase
{
    public function testItImplementsExceptionInterface()
    {
        $validationException = new ValidationException();
        $this->assertInstanceOf('Respect\Validation\Exceptions\ExceptionInterface', $validationException);
    }

    /**
     * @dataProvider providerForFormat
     */
    public function testFormatShouldReplacePlaceholdersProperly($template, $result, $vars)
    {
        $this->assertEquals(
            $result,
            ValidationException::format($template, $vars)
        );
    }

    /**
     * @dataProvider providerForStringify
     */
    public function testStringifyShouldConvertStringsProperly($input, $result)
    {
        $this->assertStringMatchesFormat(
            $result,
            ValidationException::stringify($input)
        );
    }

    public function testGetMainMessageShouldApplyTemplatePlaceholders()
    {
        $sampleValidationException = new ValidationException();
        $sampleValidationException->configure('foo', ['bar' => 1, 'baz' => 2]);
        $sampleValidationException->setTemplate('{{name}} {{bar}} {{baz}}');
        $this->assertEquals(
            'foo 1 2',
            $sampleValidationException->getMainMessage()
        );
    }

    public function testSettingTemplates()
    {
        $x = new ValidationException();
        $x->configure('bar');
        $x->setTemplate('foo');
        $this->assertEquals('foo', $x->getTemplate());
    }

    public function providerForStringify()
    {
        $object1 = new SplFileInfo('stringify.phpt'); // __toString()

        $object2 = new DateTime('1988-09-09 23:59:59');

        $object3 = new stdClass();

        $object4 = new stdClass();
        $object4->foo = 1;
        $object4->bar = false;

        $object5 = new stdClass();
        $objectRecursive = $object5;
        for ($i = 0; $i < 10; ++$i) {
            $objectRecursive->name = new stdClass();
            $objectRecursive = $objectRecursive->name;
        }

        $exception = new Exception('My message');

        $iterator1 = new ArrayIterator([1, 2, 3]);
        $iterator2 = new ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3]);

        return [
            ['', '""'],
            ['foo', '"foo"'],
            [INF, 'INF'],
            [-INF, '-INF'],
            [acos(4), 'NaN'],
            [123, '123'],
            [123.456, '123.456'],
            [[], '{ }'],
            [[false], '{ false }'],
            [[1,2,3,4,5,6,7,8,9,10], '{ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 }'],
            [range(1, 80), '{ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ... }'],
            [
                ['foo' => true, 'bar' => ['baz' => 123, 'qux' => [1, 2, 3]]],
                '{ "foo": true, "bar": { "baz": 123, "qux": { 1, 2, 3 } } }',
            ],
            [
                ['foo' => true, 'bar' => ['baz' => 123, 'qux' => ['norf' => [1,2,3]]]],
                '{ "foo": true, "bar": { "baz": 123, "qux": { "norf": ... } } }',
            ],
            [[[], 'foo'], '{ { }, "foo" }'],
            [[[1], 'foo'], '{ { 1 }, "foo" }'],
            [[1, [2, [3]]], '{ 1, { 2, { 3 } } }'],
            [[1, [2, [3, [4]]]], '{ 1, { 2, { 3, ... } } }'],
            [[1, [2, [3, [4, [5]]]]], '{ 1, { 2, { 3, ... } } }'],
            [['foo', 'bar'], '{ "foo", "bar" }'],
            [['foo', -1], '{ "foo", -1 }'],
            [$object1, '"stringify.phpt"'],
            [$object2, sprintf('"%s"', $object2->format('Y-m-d H:i:s'))],
            [$object3, '`[object] (stdClass: { })`'],
            [$object4, '`[object] (stdClass: { "foo": 1, "bar": false })`'],
            [$object5, '`[object] (stdClass: { "name": [object] (stdClass: ...) })`'],
            [
                $exception,
                '`[exception] (Exception: { "message": "My message", "code": 0, "file": "%s:%d" })`',
            ],
            [$iterator1, '`[traversable] (ArrayIterator: { 1, 2, 3 })`'],
            [$iterator2, '`[traversable] (ArrayIterator: { "a": 1, "b": 2, "c": 3 })`'],
            [stream_context_create(), '`[resource] (stream-context)`'],
            [tmpfile(), '`[resource] (stream)`'],
            [xml_parser_create(), '`[resource] (xml)`'],
            [
                [$object4, [42, 43], true, null, tmpfile()],
                '{ `[object] (stdClass: { "foo": 1, "bar": false })`, { 42, 43 }, true, null, `[resource] (stream)` }',
            ],
        ];
    }

    public function providerForFormat()
    {
        return [
            [
                '{{foo}} {{bar}} {{baz}}',
                '"hello" "world" "respect"',
                ['foo' => 'hello', 'bar' => 'world', 'baz' => 'respect'],
            ],
            [
                '{{foo}} {{bar}} {{baz}}',
                '"hello" {{bar}} "respect"',
                ['foo' => 'hello', 'baz' => 'respect'],
            ],
            [
                '{{foo}} {{bar}} {{baz}}',
                '"hello" {{bar}} "respect"',
                ['foo' => 'hello', 'bot' => 111, 'baz' => 'respect'],
            ],
        ];
    }
}
