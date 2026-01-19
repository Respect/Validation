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
use Respect\Validation\Test\Message\TestingArrayFormatter;
use Respect\Validation\Test\Message\TestingMessageRenderer;
use Respect\Validation\Test\Message\TestingStringFormatter;
use Respect\Validation\Test\TestCase;

use function uniqid;

#[Group('core')]
#[CoversClass(ResultQuery::class)]
final class ResultQueryTest extends TestCase
{
    #[Test]
    public function itShouldReturnTrueWhenResultHasPassed(): void
    {
        $result = (new ResultBuilder())->hasPassed(true)->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertTrue($resultQuery->isValid());
    }

    #[Test]
    public function itShouldReturnFalseWhenResultHasNotPassed(): void
    {
        $result = (new ResultBuilder())->hasPassed(false)->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertFalse($resultQuery->isValid());
    }

    #[Test]
    public function itShouldReturnEmptyMessageWhenResultHasPassed(): void
    {
        $result = (new ResultBuilder())->hasPassed(true)->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertSame('', $resultQuery->toMessage());
    }

    #[Test]
    public function itShouldReturnFormattedMessageWhenResultHasNotPassed(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $result = (new ResultBuilder())->hasPassed(false)->build();

        $resultQuery = $this->createResultQuery($result, renderer: $renderer, messageFormatter: $formatter);

        self::assertSame($formatter->format($result, $renderer, []), $resultQuery->toMessage());
    }

    #[Test]
    public function itShouldReturnEmptyFullMessageWhenResultHasPassed(): void
    {
        $result = (new ResultBuilder())->hasPassed(true)->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertSame('', $resultQuery->toFullMessage());
    }

    #[Test]
    public function itShouldReturnFormattedFullMessageWhenResultHasNotPassed(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $result = (new ResultBuilder())->hasPassed(false)->build();

        $resultQuery = $this->createResultQuery($result, renderer: $renderer, fullMessageFormatter: $formatter);

        self::assertSame($formatter->format($result, $renderer, []), $resultQuery->toFullMessage());
    }

    #[Test]
    public function itShouldReturnEmptyArrayWhenResultHasPassed(): void
    {
        $result = (new ResultBuilder())->hasPassed(true)->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertSame([], $resultQuery->toArrayMessages());
    }

    #[Test]
    public function itShouldReturnFormattedArrayWhenResultHasNotPassed(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingArrayFormatter();

        $result = (new ResultBuilder())->hasPassed(false)->build();

        $resultQuery = $this->createResultQuery($result, renderer: $renderer, messagesFormatter: $formatter);

        self::assertSame($formatter->format($result, $renderer, []), $resultQuery->toArrayMessages());
    }

    #[Test]
    public function itShouldConvertToStringUsingMessage(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $result = (new ResultBuilder())->hasPassed(false)->build();

        $resultQuery = $this->createResultQuery($result, renderer: $renderer, messageFormatter: $formatter);

        self::assertSame($formatter->format($result, $renderer, []), (string) $resultQuery);
    }

    #[Test]
    public function itShouldConvertToEmptyStringWhenResultHasPassed(): void
    {
        $result = (new ResultBuilder())->hasPassed(true)->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertSame('', (string) $resultQuery);
    }

    #[Test]
    public function itShouldFindByIdWhenIdMatchesCurrentResult(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $id = uniqid();
        $result = (new ResultBuilder())
            ->id($id)
            ->hasPassed(false)
            ->build();

        $resultQuery = $this->createResultQuery($result, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findById($id);

        self::assertNotNull($found);
        self::assertSame($formatter->format($result, $renderer, []), $found->toMessage());
    }

    #[Test]
    public function itShouldFindByIdInDirectChildren(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $childId = uniqid();
        $child = (new ResultBuilder())
            ->id($childId)
            ->hasPassed(false)
            ->build();

        $parent = (new ResultBuilder())
            ->id(uniqid())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery($parent, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findById($childId);

        self::assertNotNull($found);
        self::assertSame($formatter->format($child, $renderer, []), $found->toMessage());
    }

    #[Test]
    public function itShouldFindByIdInNestedChildren(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $grandchildId = uniqid();
        $grandchild = (new ResultBuilder())
            ->id($grandchildId)
            ->hasPassed(false)
            ->build();

        $child = (new ResultBuilder())
            ->id(uniqid())
            ->hasPassed(false)
            ->children($grandchild)
            ->build();

        $parent = (new ResultBuilder())
            ->id(uniqid())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery($parent, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findById($grandchildId);

        self::assertNotNull($found);
        self::assertSame($formatter->format($grandchild, $renderer, []), $found->toMessage());
    }

    #[Test]
    public function itShouldReturnNullWhenIdNotFound(): void
    {
        $result = (new ResultBuilder())
            ->id(uniqid())
            ->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertNull($resultQuery->findById(uniqid()));
    }

    #[Test]
    public function itShouldReturnNullWhenFindByIdOnResultWithNoChildren(): void
    {
        $result = (new ResultBuilder())
            ->id(uniqid())
            ->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertNull($resultQuery->findById(uniqid()));
    }

    #[Test]
    public function itShouldFindByNameWhenNameMatchesCurrentResult(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $name = uniqid();
        $result = (new ResultBuilder())
            ->name($name)
            ->hasPassed(false)
            ->build();

        $resultQuery = $this->createResultQuery($result, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findByName($name);

        self::assertNotNull($found);
        self::assertSame($formatter->format($result, $renderer, []), $found->toMessage());
    }

    #[Test]
    public function itShouldFindByNameInDirectChildren(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $childName = uniqid();
        $child = (new ResultBuilder())
            ->name($childName)
            ->hasPassed(false)
            ->build();

        $parent = (new ResultBuilder())
            ->name(uniqid())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery($parent, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findByName($childName);

        self::assertNotNull($found);
        self::assertSame($formatter->format($child, $renderer, []), $found->toMessage());
    }

    #[Test]
    public function itShouldFindByNameInNestedChildren(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $grandchildName = uniqid();
        $grandchild = (new ResultBuilder())
            ->name($grandchildName)
            ->hasPassed(false)
            ->build();

        $child = (new ResultBuilder())
            ->name(uniqid())
            ->hasPassed(false)
            ->children($grandchild)
            ->build();

        $parent = (new ResultBuilder())
            ->name(uniqid())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery($parent, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findByName($grandchildName);

        self::assertNotNull($found);
        self::assertSame($formatter->format($grandchild, $renderer, []), $found->toMessage());
    }

    #[Test]
    public function itShouldReturnNullWhenNameNotFound(): void
    {
        $result = (new ResultBuilder())
            ->name(uniqid())
            ->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertNull($resultQuery->findByName(uniqid()));
    }

    #[Test]
    public function itShouldReturnNullWhenFindByNameOnResultWithNoName(): void
    {
        $result = (new ResultBuilder())->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertNull($resultQuery->findByName(uniqid()));
    }

    #[Test]
    public function itShouldFindByPathWhenPathMatchesCurrentResult(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $path = uniqid();
        $result = (new ResultBuilder())
            ->withPath(new Path($path))
            ->hasPassed(false)
            ->build();

        $resultQuery = $this->createResultQuery($result, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findByPath($path);

        self::assertNotNull($found);
        self::assertSame($formatter->format($result, $renderer, []), $found->toMessage());
    }

    #[Test]
    public function itShouldFindByPathInDirectChildren(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $childPath = uniqid();
        $child = (new ResultBuilder())
            ->withPath(new Path($childPath))
            ->hasPassed(false)
            ->build();

        $parent = (new ResultBuilder())
            ->withPath(new Path(uniqid()))
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery($parent, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findByPath($childPath);

        self::assertNotNull($found);
        self::assertSame($formatter->format($child, $renderer, []), $found->toMessage());
    }

    #[Test]
    public function itShouldFindByDottedPathInNestedChildren(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $childPath = uniqid();
        $grandchildPath = uniqid();

        $grandchild = (new ResultBuilder())
            ->withPath(new Path($grandchildPath))
            ->hasPassed(false)
            ->build();

        $child = (new ResultBuilder())
            ->withPath(new Path($childPath))
            ->hasPassed(false)
            ->children($grandchild)
            ->build();

        $parent = (new ResultBuilder())
            ->withPath(new Path(uniqid()))
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery($parent, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findByPath($childPath . '.' . $grandchildPath);

        self::assertNotNull($found);
        self::assertSame($formatter->format($grandchild, $renderer, []), $found->toMessage());
    }

    #[Test]
    public function itShouldFindByIntegerPath(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $integerPath = 0;
        $child = (new ResultBuilder())
            ->withPath(new Path($integerPath))
            ->hasPassed(false)
            ->build();

        $parent = (new ResultBuilder())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery($parent, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findByPath($integerPath);

        self::assertNotNull($found);
        self::assertSame($formatter->format($child, $renderer, []), $found->toMessage());
    }

    #[Test]
    public function itShouldReturnNullWhenPathNotFound(): void
    {
        $result = (new ResultBuilder())
            ->withPath(new Path(uniqid()))
            ->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertNull($resultQuery->findByPath(uniqid()));
    }

    #[Test]
    public function itShouldReturnNullWhenFindByPathOnResultWithNoPath(): void
    {
        $result = (new ResultBuilder())->build();

        $resultQuery = $this->createResultQuery($result);

        self::assertNull($resultQuery->findByPath(uniqid()));
    }

    #[Test]
    public function itShouldReturnNullWhenDottedPathPartiallyMatches(): void
    {
        $childPath = uniqid();
        $child = (new ResultBuilder())
            ->withPath(new Path($childPath))
            ->hasPassed(false)
            ->build();

        $parent = (new ResultBuilder())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery($parent);

        self::assertNull($resultQuery->findByPath($childPath . '.' . uniqid()));
    }

    #[Test]
    public function itShouldReturnNullWhenChildPathDoesNotMatch(): void
    {
        $child = (new ResultBuilder())
            ->withPath(new Path(uniqid()))
            ->hasPassed(false)
            ->build();

        $parent = (new ResultBuilder())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery($parent);

        self::assertNull($resultQuery->findByPath(uniqid()));
    }

    #[Test]
    public function itShouldPreserveFormattingCapabilitiesAfterFindById(): void
    {
        $renderer = new TestingMessageRenderer();
        $messageFormatter = new TestingStringFormatter(uniqid());
        $fullMessageFormatter = new TestingStringFormatter(uniqid());

        $childId = uniqid();
        $child = (new ResultBuilder())
            ->id($childId)
            ->hasPassed(false)
            ->build();

        $parent = (new ResultBuilder())
            ->id(uniqid())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery(
            $parent,
            renderer: $renderer,
            messageFormatter: $messageFormatter,
            fullMessageFormatter: $fullMessageFormatter,
        );

        $found = $resultQuery->findById($childId);

        self::assertNotNull($found);
        self::assertSame($messageFormatter->format($child, $renderer, []), $found->toMessage());
        self::assertSame($fullMessageFormatter->format($child, $renderer, []), $found->toFullMessage());
    }

    #[Test]
    public function itShouldPreserveFormattingCapabilitiesAfterFindByName(): void
    {
        $renderer = new TestingMessageRenderer();
        $messagesFormatter = new TestingArrayFormatter();

        $childName = uniqid();
        $child = (new ResultBuilder())
            ->name($childName)
            ->hasPassed(false)
            ->build();

        $parent = (new ResultBuilder())
            ->name(uniqid())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery(
            $parent,
            renderer: $renderer,
            messagesFormatter: $messagesFormatter,
        );

        $found = $resultQuery->findByName($childName);

        self::assertNotNull($found);
        self::assertSame($messagesFormatter->format($child, $renderer, []), $found->toArrayMessages());
    }

    #[Test]
    public function itShouldPreserveFormattingCapabilitiesAfterFindByPath(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new TestingStringFormatter(uniqid());

        $childPath = uniqid();
        $child = (new ResultBuilder())
            ->withPath(new Path($childPath))
            ->hasPassed(false)
            ->build();

        $parent = (new ResultBuilder())
            ->hasPassed(false)
            ->children($child)
            ->build();

        $resultQuery = $this->createResultQuery($parent, renderer: $renderer, messageFormatter: $formatter);

        $found = $resultQuery->findByPath($childPath);

        self::assertNotNull($found);
        self::assertSame($formatter->format($child, $renderer, []), (string) $found);
    }

    private function createResultQuery(
        Result $result,
        TestingMessageRenderer|null $renderer = null,
        TestingStringFormatter|null $messageFormatter = null,
        TestingStringFormatter|null $fullMessageFormatter = null,
        TestingArrayFormatter|null $messagesFormatter = null,
    ): ResultQuery {
        return new ResultQuery(
            $result,
            $renderer ?? new TestingMessageRenderer(),
            $messageFormatter ?? new TestingStringFormatter(),
            $fullMessageFormatter ?? new TestingStringFormatter(),
            $messagesFormatter ?? new TestingArrayFormatter(),
            [],
        );
    }
}
