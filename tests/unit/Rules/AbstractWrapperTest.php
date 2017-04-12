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

use ReflectionObject;
use Respect\Validation\Validatable;

class AbstractWrapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage There is no defined validatable
     */
    public function testShouldThrowsAnExceptionWhenWrappedValidatableIsNotDefined()
    {
        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class);
        $wrapper->getValidatable();
    }

    private function bindValidatable($wrapper, $validatable)
    {
        $reflectionObject = new ReflectionObject($wrapper);
        $reflectionProperty = $reflectionObject->getProperty('validatable');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($wrapper, $validatable);
    }

    public function testShouldReturnDefinedValidatable()
    {
        $validatable = $this->createMock(Validatable::class);

        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class);
        $this->bindValidatable($wrapper, $validatable);

        $this->assertSame($validatable, $wrapper->getValidatable());
    }

    public function testShouldUseWrappedToValidate()
    {
        $input = 'Whatever';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('validate')
            ->with($input)
            ->will($this->returnValue(true));

        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class);
        $this->bindValidatable($wrapper, $validatable);

        $this->assertTrue($wrapper->validate($input));
    }

    public function testShouldUseWrappedToAssert()
    {
        $input = 'Whatever';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('assert')
            ->with($input)
            ->will($this->returnValue(true));

        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class);
        $this->bindValidatable($wrapper, $validatable);

        $this->assertTrue($wrapper->assert($input));
    }

    public function testShouldUseWrappedToCheck()
    {
        $input = 'Whatever';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('check')
            ->with($input)
            ->will($this->returnValue(true));

        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class);
        $this->bindValidatable($wrapper, $validatable);

        $this->assertTrue($wrapper->check($input));
    }

    public function testShouldPassNameOnToWrapped()
    {
        $name = 'Whatever';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects($this->once())
            ->method('setName')
            ->with($name)
            ->will($this->returnValue($validatable));

        $wrapper = $this->getMockForAbstractClass(AbstractWrapper::class);
        $this->bindValidatable($wrapper, $validatable);

        $this->assertSame($wrapper, $wrapper->setName($name));
    }
}
