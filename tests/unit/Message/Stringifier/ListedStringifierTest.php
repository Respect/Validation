<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Stringifier;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Stringifier\Stringifiers\JsonEncodableStringifier;
use Respect\Validation\Message\Placeholder\Listed;
use Respect\Validation\Test\TestCase;

#[CoversClass(ListedStringifier::class)]
final class ListedStringifierTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldNotStringifyWhenValueIsNotAnInstanceOfListed(mixed $value): void
    {
        $quoter = new JsonEncodableStringifier();
        $stringifier = new ListedStringifier($quoter);

        self::assertNull($stringifier->stringify($value, 0));
    }

    #[Test]
    public function itShouldNotStringifyEmptyListed(): void
    {
        $stringifier = new ListedStringifier(new JsonEncodableStringifier());

        self::assertNull($stringifier->stringify(new Listed([], '-'), 0));
    }

    #[Test]
    #[DataProvider('providerForListed')]
    public function itShouldStringifyWhenValueIsAnInstanceOfListed(Listed $listed, string $expected): void
    {
        $stringifier = new ListedStringifier(new JsonEncodableStringifier());

        $actual = $stringifier->stringify($listed, 0);

        self::assertSame($expected, $actual);
    }

    /** @return array<string, array{Listed, string}> */
    public static function providerForListed(): array
    {
        return [
            '1 item' => [new Listed([1], 'and'), '1'],
            '2 items' => [new Listed([1, 2], 'and'), '1 and 2'],
            '3 items' => [new Listed([1, 2, 3], 'or'), '1, 2, or 3'],
        ];
    }
}
