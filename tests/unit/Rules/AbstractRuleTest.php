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
use Respect\Validation\Test\TestCase;

use function random_int;

#[Group('core')]
#[CoversClass(AbstractRule::class)]
final class AbstractRuleTest extends TestCase
{
    #[Test]
    public function itShouldValidateSomeValidInputUsingTheInvokeMagicMethod(): void
    {
        $sut = Stub::pass(1);

        self::assertTrue($sut('something'));
    }

    #[Test]
    public function itShouldValidateSomeInvalidInputUsingTheInvokeMagicMethod(): void
    {
        $sut = Stub::fail(1);

        self::assertFalse($sut('something'));
    }

    #[Test]
    public function itShouldThrowAnExceptionOnAssertingSomeInvalidInput(): void
    {
        $input = 'something';

        $sut = Stub::fail(1);

        $this->expectException(ValidationException::class);

        $sut->assert($input);
    }

    #[Test]
    public function itShouldNotThrowAnExceptionOnAssertingSomeValidInput(): void
    {
        $input = 'something';

        $sut = Stub::pass(1);

        $this->expectNotToPerformAssertions();

        $sut->assert($input);
    }

    #[Test]
    public function itShouldThrowAnExceptionOnCheckingSomeInvalidInput(): void
    {
        $input = 'something';

        $sut = Stub::fail(1);

        $this->expectException(ValidationException::class);

        $sut->check($input);
    }

    #[Test]
    public function itShouldNotThrowAnExceptionOnCheckingSomeValidInput(): void
    {
        $input = 'something';

        $sut = Stub::pass(1);

        $this->expectNotToPerformAssertions();

        $sut->check($input);
    }

    #[Test]
    public function itShouldReturnSelfWhenSettingSomeTemplate(): void
    {
        $sut = Stub::pass(1);

        self::assertSame($sut, $sut->setTemplate('whatever'));
    }

    #[Test]
    public function itShouldReturnSelfWhenSettingSomeName(): void
    {
        $sut = Stub::pass(1);

        self::assertSame($sut, $sut->setName('whatever'));
    }

    #[Test]
    public function itShouldBeAbleToRetrieveItsName(): void
    {
        $name = 'something';

        $sut = Stub::pass(1);
        $sut->setName($name);

        self::assertSame($name, $sut->getName());
    }

    #[Test]
    public function itShouldReportErrorWithExtraParameters(): void
    {
        $extraParameterName = 'foo';
        $extraParameterValue = random_int(1, 100);

        $sut = Stub::pass(1);

        $exception = $sut->reportError('input', [$extraParameterName => $extraParameterValue]);

        self::assertSame($extraParameterValue, $exception->getParam($extraParameterName));
    }
}
