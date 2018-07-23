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

class AbstractCompositeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldDefineNameForInternalWhenAppendRuleToCompositeRule(): void
    {
        $ruleName = 'something';

        $simpleRuleMock = $this->createMock(Validatable::class);
        $simpleRuleMock
            ->expects(self::once())
            ->method('getName')
            ->will(self::returnValue(null));
        $simpleRuleMock
            ->expects(self::once())
            ->method('setName')
            ->with($ruleName);

        $compositeRuleMock = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->setName($ruleName);
        $compositeRuleMock->addRule($simpleRuleMock);
    }

    /**
     * @test
     */
    public function shouldUpdateInternalRuleNameWhenNameIsUpdated(): void
    {
        $ruleName1 = 'something';
        $ruleName2 = 'something else';

        $simpleRuleMock = $this->createMock(Validatable::class);
        $simpleRuleMock
            ->expects(self::at(0))
            ->method('getName')
            ->will(self::returnValue(null));
        $simpleRuleMock
            ->expects(self::at(2))
            ->method('getName')
            ->will(self::returnValue($ruleName1));
        $simpleRuleMock
            ->expects(self::at(1))
            ->method('setName')
            ->with($ruleName1);
        $simpleRuleMock
            ->expects(self::at(3))
            ->method('setName')
            ->with($ruleName2);

        $compositeRuleMock = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->setName($ruleName1);
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName($ruleName2);
    }

    /**
     * @test
     */
    public function shouldNotUpdateInternalRuleAlreadyHasAName(): void
    {
        $simpleRuleMock = $this->createMock(Validatable::class);
        $simpleRuleMock
            ->expects(self::any())
            ->method('getName')
            ->will(self::returnValue('something'));
        $simpleRuleMock
            ->expects(self::never())
            ->method('setName');

        $compositeRuleMock = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName('Whatever');
    }

    /**
     * @test
     */
    public function shouldUpdateInternalRuleWhenItsNameIsNull(): void
    {
        $ruleName = 'something';

        $simpleRuleMock = $this->createMock(Validatable::class);
        $simpleRuleMock
            ->expects(self::any())
            ->method('getName')
            ->will(self::returnValue(null));
        $simpleRuleMock
            ->expects(self::once())
            ->method('setName')
            ->with($ruleName);

        $compositeRuleMock = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName($ruleName);
    }

    /**
     * @test
     */
    public function shouldDefineNameForInternalRulesWhenItHasNotAName(): void
    {
        $ruleName = 'something';

        $simpleRuleMock = $this->createMock(Validatable::class);
        $simpleRuleMock
            ->expects(self::any())
            ->method('getName')
            ->will(self::returnValue(null));
        $simpleRuleMock
            ->expects(self::once())
            ->method('setName')
            ->with($ruleName);

        $compositeRuleMock = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName($ruleName);
    }

    /**
     * @test
     */
    public function shouldNotDefineNameForInternalRulesWhenItHasAName(): void
    {
        $ruleName = 'something';

        $simpleRuleMock = $this->createMock(Validatable::class);
        $simpleRuleMock
            ->expects(self::any())
            ->method('getName')
            ->will(self::returnValue($ruleName));
        $simpleRuleMock
            ->expects(self::never())
            ->method('setName');

        $compositeRuleMock = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->setName($ruleName);
    }

    /**
     * @test
     */
    public function removeRulesShouldRemoveAllTheAddedRules(): void
    {
        $simpleRuleMock = $this->createMock(Validatable::class);

        $compositeRuleMock = $this->getMockForAbstractClass(AbstractComposite::class);
        $compositeRuleMock->addRule($simpleRuleMock);
        $compositeRuleMock->removeRules();

        self::assertEmpty($compositeRuleMock->getRules());
    }

    /**
     * @test
     */
    public function shouldReturnTheAmountOfAddedRules(): void
    {
        $compositeRuleMock = $this->getMockForAbstractClass(AbstractComposite::class);
        $compositeRuleMock->addRule($this->createMock(Validatable::class));
        $compositeRuleMock->addRule($this->createMock(Validatable::class));
        $compositeRuleMock->addRule($this->createMock(Validatable::class));

        self::assertCount(3, $compositeRuleMock->getRules());
    }

    /**
     * @test
     */
    public function hasRuleShouldReturnFalseWhenThereIsNoRuleAppended(): void
    {
        $compositeRuleMock = $this->getMockForAbstractClass(AbstractComposite::class);

        self::assertFalse($compositeRuleMock->hasRule(''));
    }

    /**
     * @test
     */
    public function hasRuleShouldReturnFalseWhenRuleIsNotFound(): void
    {
        $oneSimpleRuleMock = $this->createMock(Validatable::class);

        $compositeRuleMock = $this->getMockForAbstractClass(AbstractComposite::class);
        $compositeRuleMock->addRule($oneSimpleRuleMock);

        $anotherSimpleRuleMock = $this->createMock(Validatable::class);

        self::assertFalse($compositeRuleMock->hasRule($anotherSimpleRuleMock));
    }

    /**
     * @test
     */
    public function hasRuleShouldReturnFalseWhenRulePassedAsStringIsNotFound(): void
    {
        $simpleRuleMock = $this->createMock(Validatable::class);

        $compositeRuleMock = $this->getMockForAbstractClass(AbstractComposite::class);
        $compositeRuleMock->addRule($simpleRuleMock);

        self::assertFalse($compositeRuleMock->hasRule('SomeRule'));
    }

    /**
     * @test
     */
    public function hasRuleShouldReturnTrueWhenRuleIsFound(): void
    {
        $simpleRuleMock = $this->createMock(Validatable::class);

        $compositeRuleMock = $this->getMockForAbstractClass(AbstractComposite::class);
        $compositeRuleMock->addRule($simpleRuleMock);

        self::assertTrue($compositeRuleMock->hasRule($simpleRuleMock));
    }

    /**
     * @test
     */
    public function shouldAddRulesByPassingThroughConstructor(): void
    {
        $simpleRuleMock = $this->createMock(Validatable::class);
        $anotherSimpleRuleMock = $this->createMock(Validatable::class);

        $compositeRuleMock = $this->getMockForAbstractClass(AbstractComposite::class, [
            $simpleRuleMock,
            $anotherSimpleRuleMock,
        ]);

        self::assertCount(2, $compositeRuleMock->getRules());
    }
}
