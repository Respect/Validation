<?php

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Message\TestingModifier;
use Respect\Validation\Test\TestCase;

#[CoversClass(RawModifier::class)]
final class RawModifierTest extends TestCase
{
    #[Test]
    public function itShouldNotModifyWhenModifierIsNotRaw(): void
    {
        $nextModifier = new TestingModifier();
        $modifier = new RawModifier($nextModifier);

        $value = 'some value';
        $pipe = 'notRaw';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($nextModifier->modify($value, $pipe), $result);
    }

    #[Test]
    public function itShouldNotModifyWhenValueIsNotScalar(): void
    {
        $nextModifier = new TestingModifier();
        $modifier = new RawModifier($nextModifier);

        $value = ['not', 'scalar'];
        $pipe = 'raw';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($nextModifier->modify($value, null), $result);
    }

    #[Test]
    public function itShouldModifyWhenModifierIsRawAndValueIsScalarString(): void
    {
        $nextModifier = new TestingModifier();
        $modifier = new RawModifier($nextModifier);

        $value = 'some string';
        $pipe = 'raw';

        $result = $modifier->modify($value, $pipe);

        self::assertSame($value, $result);
    }

    #[Test]
    public function itShouldModifyWhenModifierIsRawAndValueIsScalarInt(): void
    {
        $nextModifier = new TestingModifier();
        $modifier = new RawModifier($nextModifier);

        $value = 123;
        $pipe = 'raw';

        $result = $modifier->modify($value, $pipe);

        self::assertSame('123', $result);
    }

    #[Test]
    public function itShouldModifyWhenModifierIsRawAndValueIsScalarFloat(): void
    {
        $nextModifier = new TestingModifier();
        $modifier = new RawModifier($nextModifier);

        $value = 123.456;
        $pipe = 'raw';

        $result = $modifier->modify($value, $pipe);

        self::assertSame('123.456', $result);
    }

    #[Test]
    public function itShouldModifyWhenModifierIsRawAndValueIsScalarBoolTrue(): void
    {
        $nextModifier = new TestingModifier();
        $modifier = new RawModifier($nextModifier);

        $value = true;
        $pipe = 'raw';

        $result = $modifier->modify($value, $pipe);

        self::assertSame('1', $result);
    }

    #[Test]
    public function itShouldModifyWhenModifierIsRawAndValueIsScalarBoolFalse(): void
    {
        $nextModifier = new TestingModifier();
        $modifier = new RawModifier($nextModifier);

        $value = false;
        $pipe = 'raw';

        $result = $modifier->modify($value, $pipe);

        self::assertSame('0', $result);
    }
}
