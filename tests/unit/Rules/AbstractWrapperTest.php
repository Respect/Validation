<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\Rules\WrapperStub;
use Respect\Validation\Test\TestCase;

/**
 * @test core
 * @covers \Respect\Validation\Rules\AbstractWrapper
 */
final class AbstractWrapperTest extends TestCase
{
    /**
     * @test
     */
    public function shouldUseWrappedToValidate(): void
    {
        $sut = new WrapperStub(new Stub(true));

        self::assertTrue($sut->validate('Whatever'));
    }

    /**
     * @test
     */
    public function shouldUseWrappedToAssert(): void
    {
        $sut = new WrapperStub(new Stub(false));
        $this->expectException(ValidationException::class);
        $sut->assert('Whatever');
    }

    /**
     * @test
     */
    public function shouldUseWrappedToCheck(): void
    {
        $sut = new WrapperStub(new Stub(false));
        $this->expectException(ValidationException::class);
        $sut->check('Whatever');
    }

    /**
     * @test
     */
    public function shouldPassNameOnToWrapped(): void
    {
        $name = 'Whatever';

        $rule = new Stub();

        $sut = new WrapperStub($rule);
        $sut->setName($name);

        self::assertSame($name, $rule->getName());
    }
}
