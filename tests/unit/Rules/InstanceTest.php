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

use Respect\Validation\TestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Instance
 * @covers Respect\Validation\Exceptions\InstanceException
 */
class InstanceTest extends TestCase
{
    protected $instanceValidator;

    protected function setUp()
    {
        $this->instanceValidator = new Instance('ArrayObject');
    }

    public function testInstanceValidationShouldReturnFalseForEmpty()
    {
        $this->assertFalse($this->instanceValidator->__invoke(''));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\InstanceException
     */
    public function testInstanceValidationShouldNotAssertEmpty()
    {
        $this->instanceValidator->assert('');
    }

    /**
     * @expectedException Respect\Validation\Exceptions\InstanceException
     */
    public function testInstanceValidationShouldNotCheckEmpty()
    {
        $this->instanceValidator->check('');
    }

    public function testInstanceValidationShouldReturnTrueForValidInstances()
    {
        $this->assertTrue($this->instanceValidator->__invoke(new \ArrayObject()));
        $this->assertTrue($this->instanceValidator->assert(new \ArrayObject()));
        $this->assertTrue($this->instanceValidator->check(new \ArrayObject()));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\InstanceException
     */
    public function testInvalidInstancesShouldThrowInstanceException()
    {
        $this->assertFalse($this->instanceValidator->validate(new \stdClass()));
        $this->assertFalse($this->instanceValidator->assert(new \stdClass()));
    }
}
