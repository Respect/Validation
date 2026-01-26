<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(Result::class)]
final class ResultTest extends TestCase
{
    #[Test]
    public function itShouldUpdateInputWhenWithInputIsCalled(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
    }

    #[Test]
    public function itShouldUpdateAdjacentInputWhenWithInputIsCalled(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';

        $adjacent = (new ResultBuilder())
            ->input($originalInput)
            ->build();

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->adjacent($adjacent)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
        self::assertSame($newInput, $updatedResult->adjacent?->input);
        self::assertSame($originalInput, $result->adjacent?->input);
    }

    #[Test]
    public function itShouldUpdateChildrenInputWhenWithInputIsCalledAndChildHasSameInputAndPath(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';
        $path = new Path('parent');

        $child = (new ResultBuilder())
            ->input($originalInput)
            ->path($path)
            ->build();

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->path($path)
            ->children($child)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
        self::assertSame($newInput, $updatedResult->children[0]->input);
        self::assertSame($originalInput, $result->children[0]->input);
    }

    #[Test]
    public function itShouldUpdateChildrenInputWhenWithInputIsCalledAndBothHaveNullPath(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';

        $child = (new ResultBuilder())
            ->input($originalInput)
            ->build();

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->children($child)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
        self::assertSame($newInput, $updatedResult->children[0]->input);
    }

    #[Test]
    public function itShouldNotUpdateChildrenInputWhenWithInputIsCalledAndChildHasDifferentInput(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';
        $childInput = 'different';

        $child = (new ResultBuilder())
            ->input($childInput)
            ->path(new Path('parent'))
            ->build();

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->path(new Path('parent'))
            ->children($child)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
        self::assertSame($childInput, $updatedResult->children[0]->input);
    }

    #[Test]
    public function itShouldUpdateOnlyMatchingChildrenInputWhenWithInputIsCalled(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';
        $differentInput = 'different';
        $path = new Path('parent');

        $matchingChild = (new ResultBuilder())
            ->input($originalInput)
            ->path($path)
            ->build();

        $differentChild = (new ResultBuilder())
            ->input($differentInput)
            ->path($path)
            ->build();

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->path($path)
            ->children($matchingChild, $differentChild)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
        self::assertSame($newInput, $updatedResult->children[0]->input);
        self::assertSame($differentInput, $updatedResult->children[1]->input);
    }

    #[Test]
    public function itShouldNotUpdateChildrenInputWhenWithInputIsCalledAndChildHasDifferentPath(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';

        $child = (new ResultBuilder())
            ->input($originalInput)
            ->path(new Path('child'))
            ->build();

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->path(new Path('parent'))
            ->children($child)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
        self::assertSame($originalInput, $updatedResult->children[0]->input);
    }

    #[Test]
    public function itShouldUpdateInputAdjacentAndChildrenWithSameInputWhenWithInputIsCalled(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';
        $path = new Path('parent');

        $adjacent = (new ResultBuilder())
            ->input($originalInput)
            ->path($path)
            ->build();

        $child = (new ResultBuilder())
            ->input($originalInput)
            ->path($path)
            ->build();

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->path($path)
            ->adjacent($adjacent)
            ->children($child)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
        self::assertNotNull($updatedResult->adjacent);
        self::assertSame($newInput, $updatedResult->adjacent->input);
        self::assertSame($newInput, $updatedResult->children[0]->input);
    }

    #[Test]
    public function itShouldUpdateNestedChildrenInputWhenWithInputIsCalled(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';
        $path = new Path('parent');

        $grandchild = (new ResultBuilder())
            ->input($originalInput)
            ->path($path)
            ->build();

        $child = (new ResultBuilder())
            ->input($originalInput)
            ->path($path)
            ->children($grandchild)
            ->build();

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->path($path)
            ->children($child)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
        self::assertSame($newInput, $updatedResult->children[0]->input);
        self::assertSame($newInput, $updatedResult->children[0]->children[0]->input);
    }

    #[Test]
    public function itShouldNotUpdateNestedChildrenWhenWithInputIsCalledAndGrandchildHasDifferentPath(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';
        $grandchildInput = 'grandchild_input';

        $grandchild = (new ResultBuilder())
            ->input($grandchildInput)
            ->path(new Path('grandchild'))
            ->build();

        $child = (new ResultBuilder())
            ->input($originalInput)
            ->path(new Path('child'))
            ->children($grandchild)
            ->build();

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->path(new Path('parent'))
            ->children($child)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
        self::assertSame($originalInput, $updatedResult->children[0]->input);
        self::assertSame($grandchildInput, $updatedResult->children[0]->children[0]->input);
    }

    #[Test]
    public function itShouldUpdateNestedChildrenWhenWithInputIsCalledAndGrandchildHasSameInputAndPath(): void
    {
        $originalInput = 'original';
        $newInput = 'updated';

        $grandchild = (new ResultBuilder())
            ->input($originalInput)
            ->path(new Path('grandchild'))
            ->build();

        $child = (new ResultBuilder())
            ->input($originalInput)
            ->path(new Path('child'))
            ->children($grandchild)
            ->build();

        $result = (new ResultBuilder())
            ->input($originalInput)
            ->path(new Path('result'))
            ->children($child)
            ->build();

        $updatedResult = $result->withInput($newInput);

        self::assertSame($newInput, $updatedResult->input);
        self::assertSame($originalInput, $updatedResult->children[0]->input);
        self::assertSame($originalInput, $updatedResult->children[0]->children[0]->input);
    }
}
