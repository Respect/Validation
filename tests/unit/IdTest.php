<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validators\AlwaysInvalid;

#[CoversClass(Id::class)]
final class IdTest extends TestCase
{
    #[Test]
    public function shouldCreateInstanceWithValue(): void
    {
        $id = new Id('test');

        self::assertSame('test', $id->value);
    }

    #[Test]
    public function shouldCreateIdFromSimpleValidator(): void
    {
        $validator = new AlwaysInvalid();
        $id = Id::fromValidator($validator);

        self::assertSame('alwaysInvalid', $id->value);
    }

    #[Test]
    public function shouldCreateIdFromNestedValidatorBuilder(): void
    {
        $validator = ValidatorBuilder::stringType();

        $id = Id::fromValidator($validator);

        self::assertSame('stringType', $id->value);
    }

    #[Test]
    public function shouldCreateIdFromMultipleValidatorsInBuilder(): void
    {
        $validator = ValidatorBuilder::stringType()->intType();

        $id = Id::fromValidator($validator);

        self::assertSame('validatorBuilder', $id->value);
    }

    #[Test]
    public function shouldAddPrefixToValue(): void
    {
        $id = new Id('test');
        $prefixed = $id->withPrefix('my');

        self::assertSame('myTest', $prefixed->value);
        self::assertNotSame($id, $prefixed);
    }

    #[Test]
    public function shouldHandleEmptyValueWithPrefix(): void
    {
        $id = new Id('');
        $prefixed = $id->withPrefix('prefix');

        self::assertSame('prefix', $prefixed->value);
    }

    #[Test]
    public function shouldHandleMultipleRecursionInFromValidator(): void
    {
        $validator = ValidatorBuilder::init(ValidatorBuilder::stringType());

        $id = Id::fromValidator($validator);

        self::assertSame('stringType', $id->value);
    }
}
