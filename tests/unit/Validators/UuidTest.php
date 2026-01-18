<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function array_keys;
use function random_int;
use function sprintf;
use function str_replace;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

#[Group('validator')]
#[CoversClass(Uuid::class)]
final class UuidTest extends RuleTestCase
{
    private const array ALL_VERSIONS = [
        1 => 'e4eaaaf2-d142-11e1-b3e4-080027620cdd',
        2 => '000003e8-3702-21f0-9f00-325096b39f47',
        3 => '11a38b9a-b3da-360f-9353-a5a725514269',
        4 => '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a',
        5 => 'c4a760a8-dbcf-5254-a0d9-6a4474bd1b62',
        6 => '1f037034-88c0-61d0-a876-e4456153c969',
        7 => '0196f7d6-f570-7041-8106-c0011f7a9bcd',
        8 => '00112233-4455-8677-8899-aabbccddeeff',
    ];

    #[Test]
    public function itShouldThrowExceptionWhenVersionIsGreaterThanFive(): void
    {
        $version = random_int(8, PHP_INT_MAX);

        self::expectException(InvalidValidatorException::class);
        self::expectExceptionMessage('Only versions 1 to 8 are supported: ' . $version . ' given');

        new Uuid($version);
    }

    #[Test]
    public function itShouldThrowExceptionWhenVersionIsLessThanOne(): void
    {
        $version = random_int(PHP_INT_MIN, 0);

        self::expectException(InvalidValidatorException::class);
        self::expectExceptionMessage('Only versions 1 to 8 are supported: ' . $version . ' given');

        new Uuid($version);
    }

    /** @return iterable<array{Uuid, mixed}> */
    public static function providerForValidInput(): iterable
    {
        foreach (self::ALL_VERSIONS as $version => $string) {
            yield sprintf('default with UUID version %d string', $version) => [new Uuid(), $string];
            yield sprintf('default with unformatted UUID version %d string', $version) => [
                new Uuid(),
                str_replace('-', '', $string),
            ];

            yield sprintf('default with UUID version %d object', $version) => [
                new Uuid(),
                RamseyUuid::fromString($string),
            ];

            yield sprintf('expected version %1$d with UUID v%1$d string', $version) => [
                new Uuid($version),
                $string,
            ];

            yield sprintf('expected version %1$d with unformatted UUID v%1$d string', $version) => [
                new Uuid($version),
                str_replace('-', '', $string),
            ];

            yield sprintf('expected version %1$d with UUID v%1$d object', $version) => [
                new Uuid($version),
                RamseyUuid::fromString($string),
            ];
        }
    }

    /** @return iterable<array{Uuid, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'empty' => [new Uuid(), ''];
        yield 'nil/empty' => [new Uuid(), '00000000-0000-0000-0000-000000000000'];
        yield 'not UUID' => [new Uuid(), 'Not an UUID'];
        yield 'invalid UUID' => [new Uuid(), 'g71a18f4-3a13-11e7-a919-92ebcb67fe33'];
        yield 'array' => [new Uuid(), []];
        yield 'boolean true' => [new Uuid(), true];
        yield 'boolean false' => [new Uuid(), false];
        yield 'object' => [new Uuid(), new stdClass()];

        foreach (self::ALL_VERSIONS as $versionA => $string) {
            foreach (array_keys(self::ALL_VERSIONS) as $versionB) {
                if ($versionA === $versionB) {
                    continue;
                }

                yield sprintf('expected version %1$d with UUID version %2$d string', $versionA, $versionB) => [
                    new Uuid($versionB),
                    $string,
                ];

                yield sprintf('expected version %1$d with UUID version %2$d object', $versionA, $versionB) => [
                    new Uuid($versionB),
                    RamseyUuid::fromString($string),
                ];
            }
        }
    }
}
