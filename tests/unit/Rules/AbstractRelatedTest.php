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
use Respect\Validation\Validatable;

final class AbstractRelatedTest extends TestCase
{
    public function providerForOperations()
    {
        return [
            ['validate'],
            ['check'],
            ['assert'],
        ];
    }

    public function testConstructionOfAbstractRelatedClass(): void
    {
        $validatableMock = $this->createMock(Validatable::class);
        $relatedRuleMock = $this->getMockForAbstractClass(AbstractRelated::class, ['foo', $validatableMock]);

        self::assertEquals('foo', $relatedRuleMock->getName());
        self::assertEquals('foo', $relatedRuleMock->reference);
        self::assertTrue($relatedRuleMock->mandatory);
        self::assertInstanceOf(Validatable::class, $relatedRuleMock->validator);
    }

    /**
     * @dataProvider providerForOperations
     */
    public function testOperationsShouldReturnTrueWhenReferenceValidatesItsValue($method): void
    {
        $validatableMock = $this->createMock(Validatable::class);
        $validatableMock->expects($this->any())
            ->method($method)
            ->will($this->returnValue(true));

        $relatedRuleMock = $this->getMockForAbstractClass(AbstractRelated::class, ['foo', $validatableMock]);
        $relatedRuleMock->expects($this->any())
            ->method('hasReference')
            ->will($this->returnValue(true));

        self::assertTrue($relatedRuleMock->$method('foo'));
    }

    public function testValidateShouldReturnFalseWhenIsMandatoryAndThereIsNoReference(): void
    {
        $relatedRuleMock = $this->getMockForAbstractClass(AbstractRelated::class, ['foo']);
        $relatedRuleMock->expects($this->any())
            ->method('hasReference')
            ->will($this->returnValue(false));

        self::assertFalse($relatedRuleMock->validate('foo'));
    }

    public function testShouldAcceptReferenceOnConstructor(): void
    {
        $reference = 'something';

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs([$reference])
            ->getMock();

        self::assertSame($reference, $abstractMock->reference);
    }

    public function testShouldBeMandatoryByDefault(): void
    {
        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something'])
            ->getMock();

        self::assertTrue($abstractMock->mandatory);
    }

    public function testShouldAcceptReferenceAndRuleOnConstructor(): void
    {
        $ruleMock = $this->createMock(Validatable::class);

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $ruleMock])
            ->getMock();

        self::assertSame($ruleMock, $abstractMock->validator);
    }

    public function testShouldDefineRuleNameAsReferenceWhenRuleDoesNotHaveAName(): void
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

        self::assertSame($ruleMock, $abstractMock->validator);
    }

    public function testShouldNotDefineRuleNameAsReferenceWhenRuleDoesHaveAName(): void
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

        self::assertSame($ruleMock, $abstractMock->validator);
    }

    public function testShouldAcceptMandatoryFlagOnConstructor(): void
    {
        $mandatory = false;

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $this->createMock(Validatable::class), $mandatory])
            ->getMock();

        self::assertSame($mandatory, $abstractMock->mandatory);
    }

    public function testShouldDefineChildNameWhenDefiningTheNameOfTheParent(): void
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
