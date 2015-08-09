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
        $this->assertEquals(
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

    /**
     * @dataProvider providerForStringify
     */
    public function testSettingExceptionParamsMakesThemAvailable($input, $expected)
    {
        $x = new ValidationException();
        $x->setParam('foo', $input);
        $this->assertEquals(
            $expected,
            $x->getParam('foo')
        );
    }

    /**
     * @link https://github.com/Respect/Validation/pull/214
     */
    public function testFixedConstEqualsException()
    {
        $this->assertTrue(EqualsException::EQUALS === 0);
        $this->assertTrue(EqualsException::IDENTICAL === 1);
    }

    public function providerForStringify()
    {
        return array(
            array('foo', 'foo'),
            array(123, '123'),
            array(array(), ''),
            array(array(array(), 'foo'), "(), 'foo'"),
            array(array(array(1), 'foo'), "(1), 'foo'"),
            array(array(1, array(2, array(3))), "1, (2, (3))"),
            array(array(1, array(2, array(3, array(4)))), "1, (2, (3, (4)))"),
            array(array(1, array(2, array(3, array(4, array(5))))), "1, (2, (3, (4, ...)))"),
            array(array('foo', 'bar'), "'foo', 'bar'"),
            array(array('foo', -1), "'foo', -1"),
            array(array(new \stdClass, "foo"), "Object of class stdClass, 'foo'"),
            array(new \stdClass, 'Object of class stdClass'),
            array($x = new \DateTime, $x->format('Y-m-d H:i:s')),
        );
    }

    public function providerForFormat()
    {
        return array(
            array(
                '{{foo}} {{bar}} {{baz}}',
                'hello world respect',
                array('foo' => 'hello', 'bar' => 'world', 'baz' => 'respect'),
            ),
            array(
                '{{foo}} {{bar}} {{baz}}',
                'hello {{bar}} respect',
                array('foo' => 'hello', 'baz' => 'respect'),
            ),
            array(
                '{{foo}} {{bar}} {{baz}}',
                'hello {{bar}} respect',
                array('foo' => 'hello', 'bot' => 111, 'baz' => 'respect'),
            ),
        );
    }
}
