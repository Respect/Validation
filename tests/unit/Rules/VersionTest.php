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
 * @covers \Respect\Validation\Rules\Version
 * @covers \Respect\Validation\Exceptions\VersionException
 */
class VersionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidVersion
     */
    public function testValidVersionShouldReturnTrue($input)
    {
        $rule = new Version();
        $this->assertTrue($rule->__invoke($input));
        $this->assertTrue($rule->assert($input));
        $this->assertTrue($rule->check($input));
    }

    /**
     * @dataProvider providerForInvalidVersion
     * @expectedException \Respect\Validation\Exceptions\VersionException
     */
    public function testInvalidVersionShouldThrowException($input)
    {
        $rule = new Version();
        $this->assertFalse($rule->__invoke($input));
        $this->assertFalse($rule->assert($input));
    }

    public function providerForValidVersion()
    {
        return [
            ['1.0.0'],
            ['1.0.0-alpha'],
            ['1.0.0-alpha.1'],
            ['1.0.0-0.3.7'],
            ['1.0.0-x.7.z.92'],
            ['1.3.7+build.2.b8f12d7'],
            ['1.3.7-rc.1'],
        ];
    }

    public function providerForInvalidVersion()
    {
        return [
            [''],
            ['1.3.7--'],
            ['1.3.7++'],
            ['foo'],
            ['1.2.3.4'],
            ['1.2.3.4-beta'],
            ['beta'],
        ];
    }
}
