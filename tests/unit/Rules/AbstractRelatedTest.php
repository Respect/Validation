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
 * @covers \Respect\Validation\Rules\AbstractRelated
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AbstractRelatedTest extends TestCase
{
    /**
     * @return string[][]
     */
    public function providerForOperations(): array
    {
        return [
            ['validate'],
        ];
    }

    /**
     * @test
     */
    public function constructionOfAbstractRelatedClass(): void
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
     *
     * @test
     */
    public function operationsShouldReturnTrueWhenReferenceValidatesItsValue(string $method): void
    {
        $validatableMock = $this->createMock(Validatable::class);
        $validatableMock->expects(self::any())
            ->method($method)
            ->will(self::returnValue(true));

        $relatedRuleMock = $this->getMockForAbstractClass(AbstractRelated::class, ['foo', $validatableMock]);
        $relatedRuleMock->expects(self::any())
            ->method('hasReference')
            ->will(self::returnValue(true));

        self::assertTrue($relatedRuleMock->$method('foo'));
    }

    /**
     * @test
     */
    public function validateShouldReturnFalseWhenIsMandatoryAndThereIsNoReference(): void
    {
        $relatedRuleMock = $this->getMockForAbstractClass(AbstractRelated::class, ['foo']);
        $relatedRuleMock->expects(self::any())
            ->method('hasReference')
            ->will(self::returnValue(false));

        self::assertFalse($relatedRuleMock->validate('foo'));
    }

    /**
     * @test
     */
    public function shouldAcceptReferenceOnConstructor(): void
    {
        $reference = 'something';

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs([$reference])
            ->getMock();

        self::assertSame($reference, $abstractMock->reference);
    }

    /**
     * @test
     */
    public function shouldBeMandatoryByDefault(): void
    {
        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something'])
            ->getMock();

        self::assertTrue($abstractMock->mandatory);
    }

    /**
     * @test
     */
    public function shouldAcceptReferenceAndRuleOnConstructor(): void
    {
        $ruleMock = $this->createMock(Validatable::class);

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $ruleMock])
            ->getMock();

        self::assertSame($ruleMock, $abstractMock->validator);
    }

    /**
     * @test
     */
    public function shouldDefineRuleNameAsReferenceWhenRuleDoesNotHaveName(): void
    {
        $reference = 'something';

        $ruleMock = $this->createMock(Validatable::class);
        $ruleMock
            ->expects(self::at(0))
            ->method('getName')
            ->will(self::returnValue(null));
        $ruleMock
            ->expects(self::at(1))
            ->method('setName')
            ->with($reference);

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $ruleMock])
            ->getMock();

        self::assertSame($ruleMock, $abstractMock->validator);
    }

    /**
     * @test
     */
    public function shouldNotDefineRuleNameAsReferenceWhenRuleDoesHaveName(): void
    {
        $ruleMock = $this->createMock(Validatable::class);
        $ruleMock
            ->expects(self::at(0))
            ->method('getName')
            ->will(self::returnValue('something else'));
        $ruleMock
            ->expects(self::never())
            ->method('setName');

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $ruleMock])
            ->getMock();

        self::assertSame($ruleMock, $abstractMock->validator);
    }

    /**
     * @test
     */
    public function shouldAcceptMandatoryFlagOnConstructor(): void
    {
        $mandatory = false;

        $abstractMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $this->createMock(Validatable::class), $mandatory])
            ->getMock();

        self::assertFalse($abstractMock->mandatory);
    }

    /**
     * @test
     */
    public function shouldDefineChildNameWhenDefiningTheNameOfTheParent(): void
    {
        $name = 'My new name';
        $ruleMock = $this->createMock(Validatable::class);
        $ruleMock
            ->expects(self::at(0))
            ->method('getName')
            ->will(self::returnValue('something else'));
        $ruleMock
            ->expects(self::at(1))
            ->method('setName')
            ->with($name);

        $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(['something', $ruleMock])
            ->getMock();

        $ruleMock->setName($name);
    }
}
