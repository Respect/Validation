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

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractComposite
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AbstractCompositeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldDefineNameForInternalWhenAppendRuleToCompositeRule(): void
    {
        $ruleName = 'something';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::once())
            ->method('getName')
            ->will(self::returnValue(null));
        $rule
            ->expects(self::once())
            ->method('setName')
            ->with($ruleName);

        $sut = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();

        $sut->setName($ruleName);
        $sut->addRule($rule);
    }

    /**
     * @test
     */
    public function shouldUpdateInternalRuleNameWhenNameIsUpdated(): void
    {
        $ruleName1 = 'something';
        $ruleName2 = 'something else';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::at(0))
            ->method('getName')
            ->will(self::returnValue(null));
        $rule
            ->expects(self::at(2))
            ->method('getName')
            ->will(self::returnValue($ruleName1));
        $rule
            ->expects(self::at(1))
            ->method('setName')
            ->with($ruleName1);
        $rule
            ->expects(self::at(3))
            ->method('setName')
            ->with($ruleName2);

        $sut = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $sut->setName($ruleName1);
        $sut->addRule($rule);
        $sut->setName($ruleName2);
    }

    /**
     * @test
     */
    public function shouldNotUpdateInternalRuleAlreadyHasAName(): void
    {
        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::any())
            ->method('getName')
            ->will(self::returnValue('something'));
        $rule
            ->expects(self::never())
            ->method('setName');

        $sut = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();
        $sut->addRule($rule);
        $sut->setName('Whatever');
    }

    /**
     * @test
     */
    public function shouldUpdateInternalRuleWhenItsNameIsNull(): void
    {
        $ruleName = 'something';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::any())
            ->method('getName')
            ->will(self::returnValue(null));
        $rule
            ->expects(self::once())
            ->method('setName')
            ->with($ruleName);

        $sut = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();

        $sut->addRule($rule);
        $sut->setName($ruleName);
    }

    /**
     * @test
     */
    public function shouldDefineNameForInternalRulesWhenItHasNotAName(): void
    {
        $ruleName = 'something';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::any())
            ->method('getName')
            ->will(self::returnValue(null));
        $rule
            ->expects(self::once())
            ->method('setName')
            ->with($ruleName);

        $sut = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();

        $sut->addRule($rule);
        $sut->setName($ruleName);
    }

    /**
     * @test
     */
    public function shouldNotDefineNameForInternalRulesWhenItHasAName(): void
    {
        $ruleName = 'something';

        $rule = $this->createMock(Validatable::class);
        $rule
            ->expects(self::any())
            ->method('getName')
            ->will(self::returnValue($ruleName));
        $rule
            ->expects(self::never())
            ->method('setName');

        $sut = $this
            ->getMockBuilder(AbstractComposite::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();

        $sut->addRule($rule);
        $sut->setName($ruleName);
    }

    /**
     * @test
     */
    public function shouldReturnTheAmountOfAddedRules(): void
    {
        $sut = $this->getMockForAbstractClass(AbstractComposite::class);
        $sut->addRule($this->createMock(Validatable::class));
        $sut->addRule($this->createMock(Validatable::class));
        $sut->addRule($this->createMock(Validatable::class));

        self::assertCount(3, $sut->getRules());
    }

    /**
     * @test
     */
    public function shouldAddRulesByPassingThroughConstructor(): void
    {
        $rule = $this->createMock(Validatable::class);
        $anotherSimpleRuleMock = $this->createMock(Validatable::class);

        $sut = $this->getMockForAbstractClass(AbstractComposite::class, [
            $rule,
            $anotherSimpleRuleMock,
        ]);

        self::assertCount(2, $sut->getRules());
    }
}
