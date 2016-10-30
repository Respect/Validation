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

use Respect\Validation\Validatable;

final class AbstractRelatedTest extends \PHPUnit_Framework_TestCase
{
    public function providerForOperations()
    {
        return [
            ['validate'],
            ['check'],
            ['assert'],
        ];
    }

    public function testConstructionOfAbstractRelatedClass()
    {
        $validatableMock = $this->createMock(Validatable::class);
        $relatedRuleMock = $this->getMockForAbstractClass(AbstractRelated::class, ['foo', $validatableMock]);

        $this->assertEquals('foo', $relatedRuleMock->getName());
        $this->assertEquals('foo', $relatedRuleMock->reference);
        $this->assertTrue($relatedRuleMock->mandatory);
        $this->assertInstanceOf(Validatable::class, $relatedRuleMock->validator);
    }

    /**
     * @dataProvider providerForOperations
     */
    public function testOperationsShouldReturnTrueWhenReferenceValidatesItsValue($method)
    {
        $validatableMock = $this->createMock(Validatable::class);
        $validatableMock->expects($this->any())
            ->method($method)
            ->will($this->returnValue(true));

        $relatedRuleMock = $this->getMockForAbstractClass(AbstractRelated::class, ['foo', $validatableMock]);
        $relatedRuleMock->expects($this->any())
            ->method('hasReference')
            ->will($this->returnValue(true));

        $this->assertTrue($relatedRuleMock->$method('foo'));
    }

    public function testValidateShouldReturnFalseWhenIsMandatoryAndThereIsNoReference()
    {
        $relatedRuleMock = $this->getMockForAbstractClass(AbstractRelated::class, ['foo']);
        $relatedRuleMock->expects($this->any())
            ->method('hasReference')
            ->will($this->returnValue(false));

        $this->assertFalse($relatedRuleMock->validate('foo'));
    }

    public function testShouldAcceptReferenceOnConstructor()
    {
        $reference = 'something';

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs([$reference])
            ->getMock();

        $this->assertSame($reference, $abstractMock->reference);
    }

    public function testShouldBeMandatoryByDefault()
    {
        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something'])
            ->getMock();

        $this->assertTrue($abstractMock->mandatory);
    }

    public function testShouldAcceptReferenceAndRuleOnConstructor()
    {
        $ruleMock = $this->createMock(Validatable::class);

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $ruleMock])
            ->getMock();

        $this->assertSame($ruleMock, $abstractMock->validator);
    }

    public function testShouldDefineRuleNameAsReferenceWhenRuleDoesNotHaveAName()
    {
        $reference = 'something';

        $ruleMock = $this->createMock(Validatable::class);
        $ruleMock
            ->expects($this->at(0))
            ->method('getName')
            ->will($this->returnValue(null));
        $ruleMock
            ->expects($this->at(1))
            ->method('setName')
            ->with($reference);

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $ruleMock])
            ->getMock();

        $this->assertSame($ruleMock, $abstractMock->validator);
    }

    public function testShouldNotDefineRuleNameAsReferenceWhenRuleDoesHaveAName()
    {
        $reference = 'something';

        $ruleMock = $this->createMock(Validatable::class);
        $ruleMock
            ->expects($this->at(0))
            ->method('getName')
            ->will($this->returnValue('something else'));
        $ruleMock
            ->expects($this->never())
            ->method('setName');

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $ruleMock])
            ->getMock();

        $this->assertSame($ruleMock, $abstractMock->validator);
    }

    public function testShouldAcceptMandatoryFlagOnConstructor()
    {
        $mandatory = false;

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $this->createMock(Validatable::class), $mandatory])
            ->getMock();

        $this->assertSame($mandatory, $abstractMock->mandatory);
    }

    public function testShouldDefineChildNameWhenDefiningTheNameOfTheParent()
    {
        $name = 'My new name';
        $reference = 'something';

        $ruleMock = $this->createMock(Validatable::class);
        $ruleMock
            ->expects($this->at(0))
            ->method('getName')
            ->will($this->returnValue('something else'));
        $ruleMock
            ->expects($this->at(1))
            ->method('setName')
            ->with($name);

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $ruleMock])
            ->getMock();

        $ruleMock->setName($name);
    }
}
