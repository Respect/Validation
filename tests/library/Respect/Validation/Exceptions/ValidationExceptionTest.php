<?php

namespace Respect\Validation\Exceptions;

class ValidationExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForFormat
     */
    public function test_format_should_replace_placeholders_properly($template, $result, $vars)
    {
        $this->assertEquals(
            $result,
            ValidationException::format($template, $vars)
        );
    }

    /**
     * @dataProvider providerForStringify
     */
    public function test_stringify_should_convert_strings_properly($input, $result)
    {
        $this->assertEquals(
            $result,
            ValidationException::stringify($input)
        );
    }

    public function test_getMainMessage_should_apply_template_placeholders()
    {
        $sampleValidationException = new ValidationException();
        $sampleValidationException->configure('foo', array('bar' => 1, 'baz' => 2));
        $sampleValidationException->setTemplate('{{name}} {{bar}} {{baz}}');
        $this->assertEquals(
            'foo 1 2',
            $sampleValidationException->getMainMessage()
        );
    }

    public function test_setting_templates()
    {
        $x = new ValidationException();
        $x->configure('bar');
        $x->setTemplate('foo');
        $this->assertEquals('foo', $x->getTemplate());
    }

    /**
     * @dataProvider providerForStringify
     */
    public function test_setting_exception_params_makes_them_available($input, $expected)
    {
        $x = new ValidationException;
        $x->setParam('foo', $input);
        $this->assertEquals(
            $expected,
            $x->getParam('foo')
        );
    }

    public function providerForStringify()
    {
        return array(
            array('foo', 'foo'),
            array(123, '123'),
            array(array(), "Array"),
            array(new \stdClass, "Object of class stdClass"),
            array($x = new \DateTime, $x->format('Y-m-d H:i:s')),
        );
    }

    public function providerForFormat()
    {
        return array(
            array(
                '{{foo}} {{bar}} {{baz}}',
                'hello world respect',
                array('foo' => 'hello', 'bar' => 'world', 'baz' => 'respect')
            ),
            array(
                '{{foo}} {{bar}} {{baz}}',
                'hello {{bar}} respect',
                array('foo' => 'hello', 'baz' => 'respect')
            ),
            array(
                '{{foo}} {{bar}} {{baz}}',
                'hello {{bar}} respect',
                array('foo' => 'hello', 'bot' => 111, 'baz' => 'respect')
            )
        );
    }

}