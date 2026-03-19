<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function random_int;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Uuid
 *
 * @author Dick van der Heiden <d.vanderheiden@inthere.nl>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Michael Weimann <mail@michael-weimann.eu>
 */
final class UuidTest extends RuleTestCase
{
    private const UUID_VERSION_1 = 'e4eaaaf2-d142-11e1-b3e4-080027620cdd';
    private const UUID_VERSION_2 = '000003e8-3702-21f0-9f00-325096b39f47';
    private const UUID_VERSION_3 = '11a38b9a-b3da-360f-9353-a5a725514269';
    private const UUID_VERSION_4 = '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a';
    private const UUID_VERSION_5 = 'c4a760a8-dbcf-5254-a0d9-6a4474bd1b62';
    private const UUID_VERSION_6 = '1f1239e6-c96d-6964-ae1d-9da658bd666c';
    private const UUID_VERSION_7 = '019d0676-4cf1-77c4-834e-2b847eb7d6f3';
    private const UUID_VERSION_8 = '019d0676-dc57-8649-ae91-5913434dbdc2';

    /**
     * @test
     */

    public function itShouldThrowExceptionWhenVersionIsGreaterThanEight(): void
    {
        $version = random_int(9, PHP_INT_MAX);

        self::expectException(ComponentException::class);
        self::expectExceptionMessage('Only versions 1 to 8 are supported: ' . $version . ' given');

        new Uuid($version);
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionWhenVersionIsLessThanOne(): void
    {
        $version = random_int(PHP_INT_MIN, 0);

        self::expectException(ComponentException::class);
        self::expectExceptionMessage('Only versions 1 to 8 are supported: ' . $version . ' given');

        new Uuid($version);
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $sut = new Uuid();

        return [
            'any version with version 1' => [$sut, self::UUID_VERSION_1],
            'any version with version 2' => [$sut, self::UUID_VERSION_2],
            'any version with version 3' => [$sut, self::UUID_VERSION_3],
            'any version with version 4' => [$sut, self::UUID_VERSION_4],
            'any version with version 5' => [$sut, self::UUID_VERSION_5],
            'any version with version 6' => [$sut, self::UUID_VERSION_6],
            'any version with version 7' => [$sut, self::UUID_VERSION_7],
            'any version with version 8' => [$sut, self::UUID_VERSION_8],
            'version 1 with version 1' => [new Uuid(1), self::UUID_VERSION_1],
            'version 2 with version 2' => [new Uuid(2), self::UUID_VERSION_2],
            'version 3 with version 3' => [new Uuid(3), self::UUID_VERSION_3],
            'version 4 with version 4' => [new Uuid(4), self::UUID_VERSION_4],
            'version 5 with version 5' => [new Uuid(5), self::UUID_VERSION_5],
            'version 6 with version 6' => [new Uuid(6), self::UUID_VERSION_6],
            'version 7 with version 7' => [new Uuid(7), self::UUID_VERSION_7],
            'version 8 with version 8' => [new Uuid(8), self::UUID_VERSION_8],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $sut = new Uuid();
        $sutVersion1 = new Uuid(1);
        $sutVersion2 = new Uuid(2);
        $sutVersion3 = new Uuid(3);
        $sutVersion4 = new Uuid(4);
        $sutVersion5 = new Uuid(5);
        $sutVersion6 = new Uuid(6);
        $sutVersion7 = new Uuid(7);
        $sutVersion8 = new Uuid(8);

        return [
            'empty' => [$sut, ''],
            'nil/empty' => [$sut, '00000000-0000-0000-0000-000000000000'],
            'not UUID' => [$sut, 'Not an UUID'],
            'invalid UUID' => [$sut, 'g71a18f4-3a13-11e7-a919-92ebcb67fe33'],
            'invalid format' => [$sut, 'a71a18f43a1311e7a91992ebcb67fe33'],
            'version 1 with version 3' => [$sutVersion1, self::UUID_VERSION_3],
            'version 1 with version 4' => [$sutVersion1, self::UUID_VERSION_4],
            'version 1 with version 5' => [$sutVersion1, self::UUID_VERSION_5],
            'version 2 with version 5' => [$sutVersion2, self::UUID_VERSION_5],
            'version 3 with version 1' => [$sutVersion3, self::UUID_VERSION_1],
            'version 3 with version 4' => [$sutVersion3, self::UUID_VERSION_4],
            'version 3 with version 5' => [$sutVersion3, self::UUID_VERSION_5],
            'version 4 with version 1' => [$sutVersion4, self::UUID_VERSION_1],
            'version 4 with version 3' => [$sutVersion4, self::UUID_VERSION_3],
            'version 4 with version 5' => [$sutVersion4, self::UUID_VERSION_5],
            'version 5 with version 1' => [$sutVersion5, self::UUID_VERSION_1],
            'version 5 with version 3' => [$sutVersion5, self::UUID_VERSION_3],
            'version 5 with version 4' => [$sutVersion5, self::UUID_VERSION_4],
            'version 6 with version 4' => [$sutVersion6, self::UUID_VERSION_4],
            'version 7 with version 3' => [$sutVersion7, self::UUID_VERSION_3],
            'version 8 with version 5' => [$sutVersion8, self::UUID_VERSION_5],
            'array' => [$sut, []],
            'boolean true' => [$sut, true],
            'boolean false' => [$sut, false],
            'object' => [$sut, new stdClass()],
        ];
    }
}
