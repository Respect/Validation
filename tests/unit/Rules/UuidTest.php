<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Ramsey\Uuid\Uuid as RamseyUuid;
use ReflectionClass;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function random_int;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

#[Group('rule')]
#[CoversClass(Uuid::class)]
final class UuidTest extends RuleTestCase
{
    private const UUID_VERSION_1 = 'e4eaaaf2-d142-11e1-b3e4-080027620cdd'; // @phpstan-ignore classConstant.unused
    private const UUID_VERSION_2 = '000003e8-3702-21f0-9f00-325096b39f47'; // @phpstan-ignore classConstant.unused
    private const UUID_VERSION_3 = '11a38b9a-b3da-360f-9353-a5a725514269'; // @phpstan-ignore classConstant.unused
    private const UUID_VERSION_4 = '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a'; // @phpstan-ignore classConstant.unused
    private const UUID_VERSION_5 = 'c4a760a8-dbcf-5254-a0d9-6a4474bd1b62'; // @phpstan-ignore classConstant.unused
    private const UUID_VERSION_6 = '1f037034-88c0-61d0-a876-e4456153c969'; // @phpstan-ignore classConstant.unused
    private const UUID_VERSION_7 = '0196f7d6-f570-7041-8106-c0011f7a9bcd'; // @phpstan-ignore classConstant.unused
    private const UUID_VERSION_8 = '00112233-4455-8677-8899-aabbccddeeff'; // @phpstan-ignore classConstant.unused

    private const ALL_VERSIONS = [1, 2, 3, 4, 5, 6, 7, 8];

    #[Test]
    public function itShouldThrowExceptionWhenVersionIsGreaterThanFive(): void
    {
        $version = random_int(8, PHP_INT_MAX);

        self::expectException(InvalidRuleConstructorException::class);
        self::expectExceptionMessage('Only versions 1 to 8 are supported: ' . $version . ' given');

        new Uuid($version);
    }

    #[Test]
    public function itShouldThrowExceptionWhenVersionIsLessThanOne(): void
    {
        $version = random_int(PHP_INT_MIN, 0);

        self::expectException(InvalidRuleConstructorException::class);
        self::expectExceptionMessage('Only versions 1 to 8 are supported: ' . $version . ' given');

        new Uuid($version);
    }

    /** @return iterable<array{Uuid, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new Uuid();

        $tests = [];

        $classConstants = (new ReflectionClass(self::class))->getConstants();

        foreach (self::ALL_VERSIONS as $version) {
            $uuid1 = $classConstants['UUID_VERSION_' . $version];
            $uuid2 = RamseyUuid::fromString($uuid1);

            $tests[' any version with version ' . $version]                    = [$sut, $uuid1];
            $tests['version ' . $version . ' with version ' . $version]        = [new Uuid($version), $uuid1];

            $tests[' any version object with version ' . $version]             = [$sut, $uuid2];
            $tests['version ' . $version . ' object with version ' . $version] = [new Uuid($version), $uuid2];
        }

        return $tests;
    }

    /** @return iterable<array{Uuid, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $tests = [];

        $baseTests      = [
            'empty'          => '',
            'nil/empty'      => '00000000-0000-0000-0000-000000000000',
            'not UUID'       => 'Not an UUID',
            'invalid UUID'   => 'g71a18f4-3a13-11e7-a919-92ebcb67fe33',
            'invalid format' => 'a71a18f43a1311e7a91992ebcb67fe33',
            'array'          => [],
            'boolean true'   => true,
            'boolean false'  => false,
            'object'         => new stdClass(),
        ];

        $classConstants = (new ReflectionClass(self::class))->getConstants();

        $sut = new Uuid();

        foreach ($baseTests as $name => $input) {
            $tests[$name] = [$sut, $input];
        }

        foreach (self::ALL_VERSIONS as $version1) {
            foreach (self::ALL_VERSIONS as $version2) {
                if ($version1 === $version2) {
                    continue;
                }

                $uuid1 = $classConstants['UUID_VERSION_' . $version2];
                $uuid2 = RamseyUuid::fromString($uuid1);
                $sut   = new Uuid($version1);

                $tests['version ' . $version1 . ' with version ' . $version2] = [$sut, $uuid1];
                $tests['version ' . $version1 . ' with version ' . $version2] = [$sut, $uuid2];
            }
        }

        return $tests;
    }
}
