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
 * @covers \Respect\Validation\Rules\ResourceType
 * @covers \Respect\Validation\Exceptions\ResourceTypeException
 */
class ResourceTypeTest extends \PHPUnit_Framework_TestCase
{
    protected $rule;

    protected function setUp()
    {
        $this->rule = new ResourceType();
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
     * @expectedException \Respect\Validation\Exceptions\ResourceTypeException
     * @expectedExceptionMessage "Something" must be a resource
     */
    public function testShouldThrowResourceExceptionWhenChecking()
    {
        $this->rule->check('Something');
    }

    public function providerForResource()
    {
        return [
            [stream_context_create()],
            [tmpfile()],
            [xml_parser_create()],
        ];
    }

    public function providerForNonResource()
    {
        return [
            ['String'],
            [123],
            [[]],
            [function () {
            }],
            [new \stdClass()],
            [null],
        ];
    }
}
