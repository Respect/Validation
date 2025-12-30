<?php

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\Placeholder\Quoted;
use Respect\Validation\Test\Message\TestingModifier;
use Respect\Validation\Test\TestCase;

#[CoversClass(QuoteModifier::class)]
final class QuoteModifierTest extends TestCase
{
    #[Test]
    public function itShouldNotModifyWhenModifierIsNotQuote(): void
    {
        $nextModifier = new TestingModifier();
        $modifier = new QuoteModifier($nextModifier);

        $value = 'some string';
        $pipe = 'notQuote';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($nextModifier->modify($value, $pipe), $result);
    }

    #[Test]
    public function itShouldNotModifyWhenValueIsNotString(): void
    {
        $nextModifier = new TestingModifier();
        $modifier = new QuoteModifier($nextModifier);

        $value = ['not', 'a', 'string'];
        $pipe = 'quote';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($nextModifier->modify($value, $pipe), $result);
    }

    #[Test]
    public function itShouldModifyWhenModifierIsQuoteAndValueIsString(): void
    {
        $nextModifier = new TestingModifier();
        $modifier = new QuoteModifier($nextModifier);

        $value = 'some string';
        $pipe = 'quote';

        $result = $modifier->modify($value, $pipe);

        $expectedValue = new Quoted($value);
        $expected = $nextModifier->modify($expectedValue, null);

        self::assertSame($expected, $result);
    }
}
