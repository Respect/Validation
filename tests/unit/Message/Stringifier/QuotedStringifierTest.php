<?php

declare(strict_types=1);

namespace Respect\Validation\Message\Stringifier;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Stringifier\Quoters\StandardQuoter;
use Respect\Validation\Message\Placeholder\Quoted;
use Respect\Validation\Test\TestCase;

#[CoversClass(QuotedStringifier::class)]
final class QuotedStringifierTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldNotStringifyWhenValueIsNotAnInstanceOfQuoted(mixed $value): void
    {
        $quoter = new StandardQuoter(1);
        $stringifier = new QuotedStringifier($quoter);

        self::assertNull($stringifier->stringify($value, 0));
    }

    #[Test]
    #[DataProvider('providerForStringTypes')]
    public function itShouldStringifyWhenValueIsAnInstanceOfQuoted(string $value): void
    {
        $quoted = new Quoted($value);
        $quoter = new StandardQuoter(1);
        $stringifier = new QuotedStringifier($quoter);

        $expected = $quoter->quote($quoted->value, 0);
        $actual = $stringifier->stringify($quoted, 0);

        self::assertSame($expected, $actual);
    }
}
