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

use Respect\Validation\Rule;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractRelated
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 1.1.0
 */
final class AbstractRelatedTest extends RuleTestCase
{
    private function createAbstractRelatedRuleMock(): AbstractRelated
    {
        $ruleMock = $this
            ->getMockBuilder(AbstractRelated::class)
            ->setConstructorArgs(func_get_args())
            ->setMethods(['hasReference', 'getReferenceValue'])
            ->enableOriginalConstructor()
            ->getMock();

        return $ruleMock;
    }

    private function withHasReference(AbstractRelated $ruleMock, $input, string $reference, bool $hasReference): AbstractRelated
    {
        $ruleMockClone = clone $ruleMock;
        $ruleMockClone
            ->expects($this->once())
            ->method('hasReference')
            ->with($input, $reference)
            ->will($this->returnValue($hasReference));

        return $ruleMockClone;
    }

    private function withReferenceValue(AbstractRelated $ruleMock, $input, string $reference, $referenceValue): AbstractRelated
    {
        $ruleMockClone = clone $ruleMock;
        $ruleMockClone
            ->expects($this->once())
            ->method('getReferenceValue')
            ->with($input, $reference)
            ->will($this->returnValue($referenceValue));

        return $ruleMockClone;
    }

    public function providerForValidInput(): array
    {
        $reference = 'foo';
        $referenceValue = 42;
        $input = sprintf('%s:%d', $reference, $referenceValue);

        $ruleMock = $this->createAbstractRelatedRuleMock($reference);

        $ruleNotMandatoryMock = $this->createAbstractRelatedRuleMock($reference, null, false);

        $childRuleMock = $this->createRuleMock($referenceValue, true);
        $ruleWithChildRuleMock = $this->createAbstractRelatedRuleMock($reference, $childRuleMock);
        $ruleWithChildRuleMock = $this->withHasReference($ruleWithChildRuleMock, $input, $reference, true);
        $ruleWithChildRuleMock = $this->withReferenceValue($ruleWithChildRuleMock, $input, $reference, $referenceValue);

        return [
            'Mandatory With Reference Without Chile Rule' => [
                $this->withHasReference($ruleMock, $input, $reference, true),
                $input,
            ],
            'Not Mandatory Without Reference' => [
                $this->withHasReference($ruleNotMandatoryMock, $input, $reference, false),
                $input,
            ],
            'With Reference And Valid Child Rule' => [
                $ruleWithChildRuleMock,
                $input,
            ],
        ];
    }

    /**
     * @return array
     */
    public function providerForInvalidInput(): array
    {
        $reference = 'foo';
        $referenceValue = 42;
        $input = sprintf('%s:%d', $reference, $referenceValue);

        $ruleMock = $this->createAbstractRelatedRuleMock($reference);

        $childRuleMock = $this->createRuleMock($referenceValue, false);
        $ruleWithChildRuleMock = $this->createAbstractRelatedRuleMock($reference, $childRuleMock);
        $ruleWithChildRuleMock = $this->withHasReference($ruleWithChildRuleMock, $input, $reference, true);
        $ruleWithChildRuleMock = $this->withReferenceValue($ruleWithChildRuleMock, $input, $reference, $referenceValue);

        return [
            'Mandatory Without Reference' => [
                $this->withHasReference($ruleMock, $input, $reference, false),
                $input,
            ],
            'With Reference And Invalid Child Rule' => [
                $ruleWithChildRuleMock,
                $input,
            ],
        ];
    }

    /**
     * @test
     */
    public function shouldReturnAResultWithTheResultOfTheValidatedKeyWhenKeyExists(): void
    {
        $reference = 'foo';
        $referenceValue = 42;
        $input = sprintf('%s:%d', $reference, $referenceValue);

        $childRuleMock = $this->createRuleMock('42', true);

        $ruleMock = $this->createAbstractRelatedRuleMock($reference, $childRuleMock);
        $ruleMock = $this->withHasReference($ruleMock, $input, $reference, true);
        $ruleMock = $this->withReferenceValue($ruleMock, $input, $reference, $referenceValue);

        $result = $ruleMock->apply($input);

        $firstChild = $result->getChildren()[0];

        self::assertSame($firstChild->getRule(), $childRuleMock);
    }
}
