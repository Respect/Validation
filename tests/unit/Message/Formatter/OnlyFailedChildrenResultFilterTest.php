<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\OnlyFailedChildrenResultFilter;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\TestCase;

use function array_map;

#[CoversClass(OnlyFailedChildrenResultFilter::class)]
final class OnlyFailedChildrenResultFilterTest extends TestCase
{
    #[Test]
    public function itReturnsSameWhenNoChildren(): void
    {
        $parent = (new ResultBuilder())->hasPassed(true)->build(); // no children

        $filter = new OnlyFailedChildrenResultFilter();
        $result = $filter->filter($parent);

        self::assertSame($parent, $result);
    }

    #[Test]
    public function itReturnsSameWhenAllChildrenPassed(): void
    {
        $child1 = (new ResultBuilder())->id('c1')->hasPassed(true)->build();
        $child2 = (new ResultBuilder())->id('c2')->hasPassed(true)->build();

        $parent = (new ResultBuilder())
            ->hasPassed(false)
            ->children($child1, $child2)
            ->build();

        $filter = new OnlyFailedChildrenResultFilter();
        $result = $filter->filter($parent);

        self::assertSame($parent, $result);
    }

    #[Test]
    public function itKeepsChildrenWithNonNullPathUnchanged(): void
    {
        $child1 = (new ResultBuilder())->id('a')->hasPassed(false)->build(); // path null
        $child2 = (new ResultBuilder())->id('b')->hasPassed(false)->path(new Path(0))->build(); // non‑null path

        $parent = (new ResultBuilder())
            ->hasPassed(false)
            ->children($child1, $child2)
            ->build();

        $filter = new OnlyFailedChildrenResultFilter();
        $filtered = $filter->filter($parent)->children;

        self::assertCount(2, $filtered);
        $ids = array_map(static fn(Result $c) => $c->id->value, $filtered);
        self::assertContains('a', $ids);
        self::assertContains('b', $ids);
    }

    #[Test]
    public function itFiltersRecursivelyNestedChildren(): void
    {
        $grandChildFail = (new ResultBuilder())->id('gcFail')->hasPassed(false)->build();
        $grandChildPass = (new ResultBuilder())->id('gcPass')->hasPassed(true)->build();

        $child = (new ResultBuilder())
            ->id('parentChild')
            ->hasPassed(false)
            ->children($grandChildFail, $grandChildPass)
            ->build();

        $parent = (new ResultBuilder())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $filter = new OnlyFailedChildrenResultFilter();
        $filteredParent = $filter->filter($parent);

        // The parent should still have one child (the filtered child)
        self::assertCount(1, $filteredParent->children);
        $filteredChild = $filteredParent->children[0];

        // The filtered child should contain only the failing grand‑child
        self::assertCount(1, $filteredChild->children);
        self::assertSame('gcFail', $filteredChild->children[0]->id->value);
    }
}
