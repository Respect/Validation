<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;
use stdClass;

use function Respect\Stringifier\stringify;
use function sprintf;

#[Group('rule')]
#[CoversClass(KeySet::class)]
final class KeySetTest extends TestCase
{
    #[Test]
    public function shouldNotAcceptAllOfWithMoreThanOneKeyRule(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('KeySet rule accepts only Key rules');

        new KeySet(new AllOf(
            new Key('foo', Stub::daze(), false),
            new Key('bar', Stub::daze(), false),
        ));
    }

    #[Test]
    public function shouldNotAcceptAllOfWithNonKeyRule(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('KeySet rule accepts only Key rules');

        new KeySet(new AllOf(Stub::daze()));
    }

    #[Test]
    public function shouldNotAcceptNonKeyRule(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('KeySet rule accepts only Key rules');

        new KeySet(Stub::daze());
    }

    #[Test]
    public function shouldValidateKeysWhenThereAreMissingRequiredKeys(): void
    {
        $input = [
            'foo' => 42,
        ];

        $sut = new KeySet(
            new Key('foo', Stub::pass(1), true),
            new Key('bar', Stub::daze(), true),
        );

        self::assertFalse($sut->validate($input));
    }

    #[Test]
    public function shouldValidateKeysWhenThereAreMissingNonRequiredKeys(): void
    {
        $input = [
            'foo' => 42,
        ];

        $sut = new KeySet(
            new Key('foo', Stub::pass(1), true),
            new Key('bar', Stub::daze(), false),
        );

        self::assertTrue($sut->validate($input));
    }

    #[Test]
    public function shouldValidateKeysWhenThereAreMoreKeys(): void
    {
        $input = [
            'foo' => 42,
            'bar' => 'String',
            'baz' => false,
        ];

        $sut = new KeySet(
            new Key('foo', Stub::pass(1), false),
            new Key('bar', Stub::pass(1), false),
        );

        self::assertFalse($sut->validate($input));
    }

    #[Test]
    public function shouldValidateKeysWhenEmpty(): void
    {
        $sut = new KeySet(
            new Key('foo', Stub::daze(), true),
            new Key('bar', Stub::daze(), true),
        );

        self::assertFalse($sut->validate([]));
    }

    #[Test]
    public function shouldCheckKeys(): void
    {
        $sut = new KeySet(
            new Key('foo', Stub::pass(1), true),
            new Key('bar', Stub::pass(1), true),
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage(sprintf('Must have keys %s', stringify(['foo', 'bar'])));

        $sut->check([]);
    }

    #[Test]
    public function shouldAssertKeys(): void
    {
        $sut = new KeySet(
            new Key('foo', Stub::pass(1), true),
            new Key('bar', Stub::pass(1), true),
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage(sprintf('Must have keys %s', stringify(['foo', 'bar'])));

        $sut->assert([]);
    }

    #[Test]
    public function shouldWarnOfExtraKeysWithMessage(): void
    {
        $input = ['foo' => 123, 'bar' => 456];

        $sut = new KeySet(new Key('foo', Stub::pass(1), true));

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage(sprintf('Must not have keys %s', stringify(['bar'])));

        $sut->assert($input);
    }

    #[Test]
    public function cannotBeNegated(): void
    {
        $key1 = new Key('foo', Stub::pass(1), true);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"Respect\Validation\Rules\KeySet" can not be wrapped in Not()');

        new Not(new KeySet($key1));
    }

    #[Test]
    #[DataProvider('providerForInvalidArguments')]
    public function shouldThrowExceptionInCaseArgumentIsAnythingOtherThanArray(mixed $input): void
    {
        $sut = new KeySet(new Key('name'));

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage(sprintf('Must have keys %s', stringify(['name'])));

        $sut->assert($input);
    }

    /**
     * @return mixed[][]
     */
    public static function providerForInvalidArguments(): array
    {
        return [
            [''],
            [null],
            [0],
            [new stdClass()],
        ];
    }
}
