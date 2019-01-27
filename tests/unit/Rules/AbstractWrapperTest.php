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

use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;

/**
 * @test core
 *
 * @covers \Respect\Validation\Rules\AbstractWrapper
 *
 * @author Alasdair North <alasdair@runway.io>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AbstractWrapperTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnDefinedValidatable(): void
    {
        $validatable = $this->createMock(Validatable::class);

        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class, [$validatable]);

        self::assertAttributeSame($validatable, 'validatable', $wrapper);
    }

    /**
     * @test
     */
    public function shouldUseWrappedToValidate(): void
    {
        $input = 'Whatever';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('validate')
            ->with($input)
            ->will(self::returnValue(true));

        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class, [$validatable]);

        self::assertTrue($wrapper->validate($input));
    }

    /**
     * @test
     */
    public function shouldUseWrappedToAssert(): void
    {
        $input = 'Whatever';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('assert')
            ->with($input)
            ->will(self::returnValue(true));

        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class, [$validatable]);

        $wrapper->assert($input);
    }

    /**
     * @test
     */
    public function shouldUseWrappedToCheck(): void
    {
        $input = 'Whatever';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('check')
            ->with($input)
            ->will(self::returnValue(true));

        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class, [$validatable]);

        $wrapper->check($input);
    }

    /**
     * @test
     */
    public function shouldPassNameOnToWrapped(): void
    {
        $name = 'Whatever';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('setName')
            ->with($name)
            ->will(self::returnValue($validatable));

        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class, [$validatable]);

        self::assertSame($wrapper, $wrapper->setName($name));
    }
}
