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

class AbstractRelatedTest extends \PHPUnit_Framework_TestCase
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
        $validatableMock = $this->getMock('Respect\\Validation\\Validatable');
        $relatedRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractRelated', ['foo', $validatableMock]);

        $this->assertEquals('foo', $relatedRuleMock->getName());
        $this->assertEquals('foo', $relatedRuleMock->reference);
        $this->assertTrue($relatedRuleMock->mandatory);
        $this->assertInstanceOf('Respect\\Validation\\Validatable', $relatedRuleMock->validator);
    }

    /**
     * @dataProvider providerForOperations
     */
    public function testOperationsShouldReturnTrueWhenReferenceValidatesItsValue($method)
    {
        $validatableMock = $this->getMock('Respect\\Validation\\Validatable');
        $validatableMock->expects($this->any())
            ->method($method)
            ->will($this->returnValue(true));

        $relatedRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractRelated', ['foo', $validatableMock]);
        $relatedRuleMock->expects($this->any())
            ->method('hasReference')
            ->will($this->returnValue(true));

        $this->assertTrue($relatedRuleMock->$method('foo'));
    }

    public function testValidateShouldReturnFalseWhenIsMandatoryAndThereIsNoReference()
    {
        $relatedRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractRelated', ['foo']);
        $relatedRuleMock->expects($this->any())
            ->method('hasReference')
            ->will($this->returnValue(false));

        $this->assertFalse($relatedRuleMock->validate('foo'));
    }
}
