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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Resource
 * @covers Respect\Validation\Exceptions\ResourceException
 */
class ResourceTest extends \PHPUnit_Framework_TestCase
{
    protected $rule;

    protected function setUp()
    {
        $this->rule = new Resource();
    }

    /**
     * @dataProvider providerForResource
     */
    public function testShouldValidateResourceNumbers($input)
    {
        $this->assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForNonResource
     */
    public function testShouldNotValidateNonResourceNumbers($input)
    {
        $this->assertFalse($this->rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ResourceException
     * @expectedExceptionMessage "Something" must be a resource
     */
    public function testShouldThrowResourceExceptionWhenChecking()
    {
        $this->rule->check('Something');
    }

    public function providerForResource()
    {
        return array(
            array(''),
            array(stream_context_create()),
            array(tmpfile()),
            array(xml_parser_create()),
        );
    }

    public function providerForNonResource()
    {
        return array(
            array('String'),
            array(123),
            array(array()),
            array(function () {}),
            array(new \stdClass()),
            array(null),
        );
    }
}
