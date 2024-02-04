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
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\Rules\WrapperStub;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(AbstractWrapper::class)]
final class AbstractWrapperTest extends TestCase
{
    #[Test]
    public function shouldUseWrappedToValidate(): void
    {
        $sut = new WrapperStub(Stub::pass(1));

        self::assertTrue($sut->validate('Whatever'));
    }

    #[Test]
    public function shouldUseWrappedToAssert(): void
    {
        $sut = new WrapperStub(Stub::fail(1));
        $this->expectException(ValidationException::class);
        $sut->assert('Whatever');
    }

    #[Test]
    public function shouldUseWrappedToCheck(): void
    {
        $sut = new WrapperStub(Stub::fail(1));
        $this->expectException(ValidationException::class);
        $sut->check('Whatever');
    }

    #[Test]
    public function shouldPassNameOnToWrapped(): void
    {
        $name = 'Whatever';

        $rule = Stub::pass(1);

        $sut = new WrapperStub($rule);
        $sut->setName($name);

        self::assertSame($name, $rule->getName());
    }
}
