<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Ramsey\Uuid\Uuid as RamseyUuid;
use ReflectionClass;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function class_exists;
use function random_int;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

/**
 * @group  rule
 *
 * @covers \Respect\Validation\Rules\Uuid
 *
 * @author Dick van der Heiden <d.vanderheiden@inthere.nl>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Michael Weimann <mail@michael-weimann.eu>
 */
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

    private const NATIVE_VERSIONS = [1, 3, 4, 5];
    private const ALL_VERSIONS    = [1, 2, 3, 4, 5, 6, 7, 8];

    private static ?bool $ramseyUuidIsLoaded = null;

    /**
     * @test
     */
    public function itShouldThrowExceptionWhenVersionIsTwo(): void
    {
        self::expectException(ComponentException::class);
        self::expectExceptionMessage('Only versions 1, 3, 4, and 5 are supported: 2 given');

        new Uuid(2, false);
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionWhenVersionIsGreaterThanMax(): void
    {
        $version = random_int(6, PHP_INT_MAX);

        self::expectException(ComponentException::class);
        self::expectExceptionMessage('Only versions 1, 3, 4, and 5 are supported: ' . $version . ' given');
        new Uuid($version, false);

        if (!self::ramseyUuidIsLoaded()) {
            return;
        }

        self::expectException(ComponentException::class);
        self::expectExceptionMessage('Only versions 1 to 8 are supported: ' . $version . ' given');
        new Uuid($version, true);
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionWhenVersionIsLessThanOne(): void
    {
        $version = random_int(PHP_INT_MIN, 0);

        self::expectException(ComponentException::class);
        self::expectExceptionMessage('Only versions 1, 3, 4, and 5 are supported: ' . $version . ' given');
        new Uuid($version, false);

        if (!self::ramseyUuidIsLoaded()) {
            return;
        }

        self::expectException(ComponentException::class);
        self::expectExceptionMessage('Only versions 1 to 8 are supported: ' . $version . ' given');
        new Uuid($version, true);
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $tests = [];

        $thisClass      = new ReflectionClass(self::class);
        $classConstants = $thisClass->getConstants();

        $sutNative = new Uuid();
        foreach (self::NATIVE_VERSIONS as $version) {
            $tests[' any version with version ' . $version] = [
                $sutNative,
                $classConstants['UUID_VERSION_' . $version],
            ];

            $tests['version ' . $version . ' with version ' . $version] = [
                new Uuid($version),
                $classConstants['UUID_VERSION_' . $version],
            ];
        }

        if (self::ramseyUuidIsLoaded()) {
            $sutRamsey = new Uuid(null, true);
            foreach (self::ALL_VERSIONS as $version) {
                $tests[' any version with version ' . $version . ' ramsey/uuid']             = [
                    $sutRamsey,
                    $classConstants['UUID_VERSION_' . $version],
                ];
                $tests['version ' . $version . ' with version ' . $version . ' ramsey/uuid'] = [
                    new Uuid($version, true),
                    $classConstants['UUID_VERSION_' . $version],
                ];
            }
        }

        return $tests;
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $tests          = [];
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
        $thisClass      = new ReflectionClass(self::class);
        $classConstants = $thisClass->getConstants();

        $sutNative = new Uuid();
        foreach ($baseTests as $name => $input) {
            $tests[$name] = [$sutNative, $input];
        }

        foreach (self::NATIVE_VERSIONS as $version1) {
            foreach (self::NATIVE_VERSIONS as $version2) {
                if ($version1 === $version2) {
                    continue;
                }

                $tests['version ' . $version1 . ' with version ' . $version2] = [
                    new Uuid($version1),
                    $classConstants['UUID_VERSION_' . $version2],
                ];
            }
        }

        if (self::ramseyUuidIsLoaded()) {
            $sutRamsey = new Uuid(null, true);
            foreach ($baseTests as $name => $input) {
                $tests[$name . ' ramsey/uuid'] = [$sutRamsey, $input];
            }

            foreach (self::ALL_VERSIONS as $version1) {
                foreach (self::ALL_VERSIONS as $version2) {
                    if ($version1 === $version2) {
                        continue;
                    }

                    $tests['version ' . $version1 . ' with version ' . $version2] = [
                        new Uuid($version1, true),
                        $classConstants['UUID_VERSION_' . $version2],
                    ];
                }
            }
        }

        return $tests;
    }

    protected static function ramseyUuidIsLoaded(): bool
    {
        if (self::$ramseyUuidIsLoaded === null) {
            self::$ramseyUuidIsLoaded = class_exists(RamseyUuid::class);
        }

        return self::$ramseyUuidIsLoaded;
    }
}
