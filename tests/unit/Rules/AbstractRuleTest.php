<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

use function random_int;

/**
 * @covers \Respect\Validation\Rules\AbstractRule
 */
final class AbstractRuleTest extends TestCase
{
    /**
     * @covers \Respect\Validation\Rules\AbstractRule::__invoke
     * @test
     */
    public function itShouldValidateSomeValidInputUsingTheInvokeMagicMethod(): void
    {
        $sut = new Stub(true);

        self::assertTrue($sut('something'));
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::__invoke
     * @test
     */
    public function itShouldValidateSomeInvalidInputUsingTheInvokeMagicMethod(): void
    {
        $sut = new Stub(false);

        self::assertFalse($sut('something'));
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::assert
     * @test
     */
    public function itShouldThrowAnExceptionOnAssertingSomeInvalidInput(): void
    {
        $input = 'something';

        $sut = new Stub(false);

        $this->expectException(ValidationException::class);

        $sut->assert($input);
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::assert
     * @test
     */
    public function itShouldNotThrowAnExceptionOnAssertingSomeValidInput(): void
    {
        $input = 'something';

        $sut = new Stub(true);

        $this->expectNotToPerformAssertions();

        $sut->assert($input);
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::check
     * @test
     */
    public function itShouldThrowAnExceptionOnCheckingSomeInvalidInput(): void
    {
        $input = 'something';

        $sut = new Stub(false);

        $this->expectException(ValidationException::class);

        $sut->check($input);
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::check
     * @test
     */
    public function itShouldNotThrowAnExceptionOnCheckingSomeValidInput(): void
    {
        $input = 'something';

        $sut = new Stub(true);

        $this->expectNotToPerformAssertions();

        $sut->check($input);
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::setTemplate
     * @test
     */
    public function itShouldReturnSelfWhenSettingSomeTemplate(): void
    {
        $sut = new Stub();

        self::assertSame($sut, $sut->setTemplate('whatever'));
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::setName
     * @test
     */
    public function itShouldReturnSelfWhenSettingSomeName(): void
    {
        $sut = new Stub();

        self::assertSame($sut, $sut->setName('whatever'));
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::getName
     * @test
     */
    public function itShouldBeAbleToRetrieveItsName(): void
    {
        $name = 'something';

        $sut = new Stub();
        $sut->setName($name);

        self::assertSame($name, $sut->getName());
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::getName
     * @test
     */
    public function itShouldReportErrorWithExtraParameters(): void
    {
        $extraParameterName = 'foo';
        $extraParameterValue = random_int(1, 100);

        $sut = new Stub();

        $exception = $sut->reportError('input', [$extraParameterName => $extraParameterValue]);

        self::assertSame($extraParameterValue, $exception->getParam($extraParameterName));
    }
}
