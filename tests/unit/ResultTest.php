<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation;

/**
 * @covers Respect\Validation\Result
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 2.0.0
 */
final class ResultTest extends \PHPUnit_Framework_TestCase
{
    private function getResultsByQuantity(int $quantity, bool $isValid, $input, Rule $rule)
    {
        $results = [];
        for ($index = 0; $index < $quantity; ++$index) {
            $results[] = new Result($isValid, $input, $rule);
        }

        return $results;
    }

    /**
     * @test
     */
    public function shouldAcceptStatusInputAndRuleOnConstructor()
    {
        $status = false;
        $input = 'some input';
        $rule = $this->createMock(Rule::class);

        $result = new Result($status, $input, $rule);

        $this->assertSame($status, $result->isValid());
        $this->assertSame($input, $result->getInput());
        $this->assertSame($rule, $result->getRule());
    }

    /**
     * @test
     */
    public function shouldAcceptPropertiesOnConstructor()
    {
        $properties = [
            'foo' => new \stdClass(),
        ];

        $result = new Result(true, 'input', $this->createMock(Rule::class), $properties);

        $this->assertSame($properties, $result->getProperties());
    }

    /**
     * @test
     */
    public function shouldAcceptChildrenOnConstructor()
    {
        $isValid = true;
        $input = 'input';
        $rule = $this->createMock(Rule::class);

        $children = $this->getResultsByQuantity(3, $isValid, $input, $rule);

        $result = new Result($isValid, $input, $rule, [], ...$children);

        $this->assertSame($children, $result->getChildren());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWhenInverting()
    {
        $result1 = new Result(true, 'input', $this->createMock(Rule::class));
        $result2 = $result1->invert();

        $this->assertNotSame($result1, $result2);
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithADifferentStatusWhenInverting()
    {
        $result1 = new Result(true, 'input', $this->createMock(Rule::class));
        $result2 = $result1->invert();

        $this->assertNotEquals($result1->isValid(), $result2->isValid());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithTheSameInputWhenInverting()
    {
        $result1 = new Result(true, 'input', $this->createMock(Rule::class));
        $result2 = $result1->invert();

        $this->assertSame($result1->getInput(), $result2->getInput());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithTheSameRuleWhenInverting()
    {
        $result1 = new Result(true, 'input', $this->createMock(Rule::class));
        $result2 = $result1->invert();

        $this->assertSame($result1->getRule(), $result2->getRule());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithTheSamePropertiesWhenInverting()
    {
        $result1 = new Result(true, 'input', $this->createMock(Rule::class), ['foo' => true]);
        $result2 = $result1->invert();

        $this->assertSame($result1->getProperties(), $result2->getProperties());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithTheSameChildrenWhenInverting()
    {
        $isValid = true;
        $input = 'input';
        $rule = $this->createMock(Rule::class);

        $children = $this->getResultsByQuantity(1, $isValid, $input, $rule);

        $result1 = new Result($isValid, $input, $rule, [], ...$children);
        $result2 = $result1->invert();

        $this->assertSame($result1->getChildren(), $result2->getChildren());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithTheDefinedPropertiesWhenInverting()
    {
        $properties1 = ['foo' => 123, 'bar' => 42];
        $properties2 = ['foo' => 456];

        $result1 = new Result(true, 'input', $this->createMock(Rule::class), $properties1);
        $result2 = $result1->mergeProperties($properties2);

        $this->assertArrayHasKey('bar', $result2->getProperties());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithOverwrittenPropertiesWhenInverting()
    {
        $properties1 = ['foo' => 123];
        $properties2 = ['foo' => 456];

        $result1 = new Result(true, 'input', $this->createMock(Rule::class), $properties1);
        $result2 = $result1->mergeProperties($properties2);

        $this->assertNotEquals($result1->getProperties(), $result2->getProperties());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithTheSameValidationWhenMergingProperties()
    {
        $result1 = new Result(true, 'input', $this->createMock(Rule::class));
        $result2 = $result1->mergeProperties([]);

        $this->assertSame($result1->isValid(), $result2->isValid());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithTheSameInputWhenMergingProperties()
    {
        $result1 = new Result(true, 'input', $this->createMock(Rule::class));
        $result2 = $result1->mergeProperties([]);

        $this->assertSame($result1->getInput(), $result2->getInput());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithTheSameRuleWhenMergingProperties()
    {
        $result1 = new Result(true, 'input', $this->createMock(Rule::class));
        $result2 = $result1->mergeProperties([]);

        $this->assertSame($result1->getRule(), $result2->getRule());
    }

    /**
     * @test
     */
    public function shouldCreateANewResultWithTheSameChildrenWhenMergingProperties()
    {
        $isValid = true;
        $input = 'input';
        $rule = $this->createMock(Rule::class);

        $children = $this->getResultsByQuantity(1, $isValid, $input, $rule);

        $result1 = new Result($isValid, $input, $rule, [], ...$children);
        $result2 = $result1->mergeProperties([]);

        $this->assertSame($result1->getChildren(), $result2->getChildren());
    }
}
