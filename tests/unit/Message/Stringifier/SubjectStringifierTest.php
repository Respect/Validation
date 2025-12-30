<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Stringifier;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\Placeholder\Subject;
use Respect\Validation\Name;
use Respect\Validation\Path;
use Respect\Validation\Test\Message\TestingStringifier;
use Respect\Validation\Test\TestCase;
use stdClass;

use function sprintf;

#[CoversClass(SubjectStringifier::class)]
final class SubjectStringifierTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonSubjectValues')]
    public function itShouldNotStringifyWhenValueIsNotAnInstanceOfSubject(mixed $value): void
    {
        $stringifier = new SubjectStringifier(new TestingStringifier());

        self::assertNull($stringifier->stringify($value, 0));
    }

    #[Test]
    public function itShouldStringifyInputWhenPathAndNameAreNull(): void
    {
        $input = ['test' => 'value'];
        $subject = new Subject($input);

        $testingStringifier = new TestingStringifier();
        $stringifier = new SubjectStringifier($testingStringifier);

        $expected = $testingStringifier->stringify($input, 0);
        $actual = $stringifier->stringify($subject, 0);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldStringifyPathWhenNameIsNull(): void
    {
        $path = new Path('field1');
        $subject = new Subject('input', $path);

        $testingStringifier = new TestingStringifier();
        $stringifier = new SubjectStringifier($testingStringifier);

        $expected = $testingStringifier->stringify($path, 0);
        $actual = $stringifier->stringify($subject, 0);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldStringifyNameWhenPathIsNull(): void
    {
        $name = new Name('field_name');
        $subject = new Subject('input', null, $name);

        $testingStringifier = new TestingStringifier();
        $stringifier = new SubjectStringifier($testingStringifier);

        $expected = $testingStringifier->stringify($name, 0);
        $actual = $stringifier->stringify($subject, 0);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldStringifyNameWhenNameHasPrecedence(): void
    {
        $path = new Path('field1');
        $name = new Name('field_name');
        $subject = new Subject('input', $path, $name, true);

        $testingStringifier = new TestingStringifier();
        $stringifier = new SubjectStringifier($testingStringifier);

        $expected = $testingStringifier->stringify($name, 0);
        $actual = $stringifier->stringify($subject, 0);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldStringifyWithPathAndNameWhenNameHasNoPrecedence(): void
    {
        $path = new Path('field1');
        $name = new Name('field_name');
        $subject = new Subject('input', $path, $name, false);

        $testingStringifier = new TestingStringifier();
        $stringifier = new SubjectStringifier($testingStringifier);

        $pathString = $testingStringifier->stringify($path, 0);
        $nameString = $testingStringifier->stringify($name, 0);
        $expected = sprintf('%s (<- %s)', $pathString, $nameString);
        $actual = $stringifier->stringify($subject, 0);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldStringifyWithNestedPathWhenNameHasNoPrecedence(): void
    {
        $path1 = new Path('field1');
        $path2 = new Path('field2', $path1);
        $name = new Name('field_name');
        $subject = new Subject('input', $path2, $name, false);

        $testingStringifier = new TestingStringifier();
        $stringifier = new SubjectStringifier($testingStringifier);

        $pathString = $testingStringifier->stringify($path2, 0);
        $nameString = $testingStringifier->stringify($name, 0);
        $expected = sprintf('%s (<- %s)', $pathString, $nameString);
        $actual = $stringifier->stringify($subject, 0);

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
