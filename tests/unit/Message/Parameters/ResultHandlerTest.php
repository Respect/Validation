<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Parameters;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Name;
use Respect\Validation\Path;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingHandler;
use Respect\Validation\Test\TestCase;
use stdClass;

use function sprintf;

#[CoversClass(ResultHandler::class)]
final class ResultHandlerTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonSubjectValues')]
    public function itShouldNotStringifyWhenValueIsNotAnInstanceOfSubject(mixed $value): void
    {
        $handler = new ResultHandler(new TestingHandler());

        self::assertNull($handler->handle($value, 0));
    }

    #[Test]
    public function itShouldStringifyInputWhenPathAndNameAreNull(): void
    {
        $input = ['test' => 'value'];
        $result = (new ResultBuilder())->input($input)->build();

        $testingHandler = new TestingHandler();
        $handler = new ResultHandler($testingHandler);

        $expected = $testingHandler->handle($input, 0);
        $actual = $handler->handle($result, 0);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldStringifyPathWhenNameIsNull(): void
    {
        $path = new Path('field1');
        $result = (new ResultBuilder())->path($path)->build();

        $testingHandler = new TestingHandler();
        $handler = new ResultHandler($testingHandler);

        $expected = $testingHandler->handle($path, 0);
        $actual = $handler->handle($result, 0);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldStringifyNameWhenPathIsNull(): void
    {
        $name = new Name('field_name');
        $result = (new ResultBuilder())->name($name)->build();

        $testingHandler = new TestingHandler();
        $handler = new ResultHandler($testingHandler);

        $expected = $testingHandler->handle($name, 0);
        $actual = $handler->handle($result, 0);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldStringifyNameWhenNameHasPrecedence(): void
    {
        $path = new Path('field1');
        $name = new Name('field_name');
        $result = (new ResultBuilder())->name($name)->path($path)->hasPrecedentName(true)->build();

        $testingHandler = new TestingHandler();
        $handler = new ResultHandler($testingHandler);

        $expected = $testingHandler->handle($name, 0);
        $actual = $handler->handle($result, 0);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldStringifyWithPathAndNameWhenNameHasNoPrecedence(): void
    {
        $path = new Path('field1');
        $name = new Name('field_name');
        $result = (new ResultBuilder())->name($name)->path($path)->hasPrecedentName(false)->build();

        $testingHandler = new TestingHandler();
        $handler = new ResultHandler($testingHandler);

        $pathString = $testingHandler->handle($path, 0);
        $nameString = $testingHandler->handle($name, 0);
        $expected = sprintf('%s (<- %s)', $pathString, $nameString);
        $actual = $handler->handle($result, 0);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldStringifyWithNestedPathWhenNameHasNoPrecedence(): void
    {
        $path1 = new Path('field1');
        $path2 = new Path('field2', $path1);
        $name = new Name('field_name');
        $result = (new ResultBuilder())->name($name)->path($path2)->hasPrecedentName(false)->build();

        $testingHandler = new TestingHandler();
        $handler = new ResultHandler($testingHandler);

        $pathString = $testingHandler->handle($path2, 0);
        $nameString = $testingHandler->handle($name, 0);
        $expected = sprintf('%s (<- %s)', $pathString, $nameString);
        $actual = $handler->handle($result, 0);

        self::assertSame($expected, $actual);
    }

    /** @return array<string, array{mixed}> */
    public static function providerForNonSubjectValues(): array
    {
        return [
            'string' => ['test'],
            'integer' => [123],
            'boolean' => [true],
            'array' => [['test']],
            'object' => [new stdClass()],
            'null' => [null],
        ];
    }
}
