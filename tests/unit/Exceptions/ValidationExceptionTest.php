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
use SplFileInfo;
use stdClass;

class ValidationExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testItImplementsValidationExceptionInterface()
    {
        $validationException = new ValidationException();
        $this->assertInstanceOf('Respect\Validation\Exceptions\ValidationExceptionInterface', $validationException);
    }

    public function testItDoesNotImplementNestedValidationExceptionInterface()
    {
        $validationException = new ValidationException();
        $this->assertNotInstanceOf('Respect\Validation\Exceptions\NestedValidationExceptionInterface',
            $validationException);
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
        $sampleValidationException->configure('foo', array('bar' => 1, 'baz' => 2));
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

        $iterator1 = new ArrayIterator(array(1, 2, 3));
        $iterator2 = new ArrayIterator(array('a' => 1, 'b' => 2, 'c' => 3));

        return array(
            array('', '""'),
            array('foo', '"foo"'),
            array(INF, 'INF'),
            array(-INF, '-INF'),
            array(acos(4), 'NaN'),
            array(123, '123'),
            array(123.456, '123.456'),
            array(array(), '{ }'),
            array(array(false), '{ false }'),
            array(array(1,2,3,4,5,6,7,8,9,10), '{ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 }'),
            array(range(1, 80), '{ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ... }'),
            array(
                array('foo' => true, 'bar' => array('baz' => 123, 'qux' => array(1, 2, 3))),
                '{ "foo": true, "bar": { "baz": 123, "qux": { 1, 2, 3 } } }'
            ),
            array(
                array('foo' => true, 'bar' => array('baz' => 123, 'qux' => array('norf' => array(1,2,3)))),
                '{ "foo": true, "bar": { "baz": 123, "qux": { "norf": ... } } }'
            ),
            array(array(array(), 'foo'), '{ { }, "foo" }'),
            array(array(array(1), 'foo'), '{ { 1 }, "foo" }'),
            array(array(1, array(2, array(3))), '{ 1, { 2, { 3 } } }'),
            array(array(1, array(2, array(3, array(4)))), '{ 1, { 2, { 3, ... } } }'),
            array(array(1, array(2, array(3, array(4, array(5))))), '{ 1, { 2, { 3, ... } } }'),
            array(array('foo', 'bar'), '{ "foo", "bar" }'),
            array(array('foo', -1), '{ "foo", -1 }'),
            array($object1, '"stringify.phpt"'),
            array($object2, sprintf('"%s"', $object2->format('Y-m-d H:i:s'))),
            array($object3, '`[object] (stdClass: { })`'),
            array($object4, '`[object] (stdClass: { "foo": 1, "bar": false })`'),
            array($object5, '`[object] (stdClass: { "name": [object] (stdClass: ...) })`'),
            array(
                $exception,
                '`[exception] (Exception: { "message": "My message", "code": 0, "file": "%s:%d" })`'
            ),
            array($iterator1, '`[traversable] (ArrayIterator: { 1, 2, 3 })`'),
            array($iterator2, '`[traversable] (ArrayIterator: { "a": 1, "b": 2, "c": 3 })`'),
            array(stream_context_create(), '`[resource] (stream-context)`'),
            array(tmpfile(), '`[resource] (stream)`'),
            array(xml_parser_create(), '`[resource] (xml)`'),
            array(
                array($object4, array(42, 43), true, null, tmpfile()),
                '{ `[object] (stdClass: { "foo": 1, "bar": false })`, { 42, 43 }, true, null, `[resource] (stream)` }'
            ),
        );
    }

    public function providerForFormat()
    {
        return array(
            array(
                '{{foo}} {{bar}} {{baz}}',
                '"hello" "world" "respect"',
                array('foo' => 'hello', 'bar' => 'world', 'baz' => 'respect'),
            ),
            array(
                '{{foo}} {{bar}} {{baz}}',
                '"hello" {{bar}} "respect"',
                array('foo' => 'hello', 'baz' => 'respect'),
            ),
            array(
                '{{foo}} {{bar}} {{baz}}',
                '"hello" {{bar}} "respect"',
                array('foo' => 'hello', 'bot' => 111, 'baz' => 'respect'),
            ),
        );
    }
}
