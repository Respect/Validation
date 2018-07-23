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
 * @covers \Respect\Validation\Exceptions\InstanceException
 * @covers \Respect\Validation\Rules\Instance
 */
class InstanceTest extends TestCase
{
    protected $instanceValidator;

    protected function setUp(): void
    {
        $this->instanceValidator = new Instance('ArrayObject');
    }

    /**
     * @test
     */
    public function instanceValidationShouldReturnFalseForEmpty(): void
    {
        self::assertFalse($this->instanceValidator->__invoke(''));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\InstanceException
     *
     * @test
     */
    public function instanceValidationShouldNotAssertEmpty(): void
    {
        $this->instanceValidator->assert('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\InstanceException
     *
     * @test
     */
    public function instanceValidationShouldNotCheckEmpty(): void
    {
        $this->instanceValidator->check('');
    }

    /**
     * @test
     */
    public function instanceValidationShouldReturnTrueForValidInstances(): void
    {
        self::assertTrue($this->instanceValidator->__invoke(new \ArrayObject()));
        $this->instanceValidator->assert(new \ArrayObject());
        $this->instanceValidator->check(new \ArrayObject());
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\InstanceException
     *
     * @test
     */
    public function invalidInstancesShouldThrowInstanceException(): void
    {
        self::assertFalse($this->instanceValidator->validate(new \stdClass()));
        $this->instanceValidator->assert(new \stdClass());
    }
}
