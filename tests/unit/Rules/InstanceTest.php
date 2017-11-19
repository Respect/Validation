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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Instance
 * @covers \Respect\Validation\Exceptions\InstanceException
 */
class InstanceTest extends TestCase
{
    protected $instanceValidator;

    protected function setUp(): void
    {
        $this->instanceValidator = new Instance('ArrayObject');
    }

    public function testInstanceValidationShouldReturnFalseForEmpty(): void
    {
        self::assertFalse($this->instanceValidator->__invoke(''));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\InstanceException
     */
    public function testInstanceValidationShouldNotAssertEmpty(): void
    {
        $this->instanceValidator->assert('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\InstanceException
     */
    public function testInstanceValidationShouldNotCheckEmpty(): void
    {
        $this->instanceValidator->check('');
    }

    public function testInstanceValidationShouldReturnTrueForValidInstances(): void
    {
        self::assertTrue($this->instanceValidator->__invoke(new \ArrayObject()));
        self::assertTrue($this->instanceValidator->assert(new \ArrayObject()));
        self::assertTrue($this->instanceValidator->check(new \ArrayObject()));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\InstanceException
     */
    public function testInvalidInstancesShouldThrowInstanceException(): void
    {
        self::assertFalse($this->instanceValidator->validate(new \stdClass()));
        self::assertFalse($this->instanceValidator->assert(new \stdClass()));
    }
}
