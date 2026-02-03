<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;

use function sprintf;
use function uniqid;

#[CoversClass(ValidatorBuilder::class)]
final class ValidatorBuilderTest extends TestCase
{
    #[Test]
    public function invalidRuleClassShouldThrowComponentException(): void
    {
        $this->expectException(ComponentException::class);

        // @phpstan-ignore-next-line
        ValidatorBuilder::iDoNotExistSoIShouldThrowException();
    }

    #[Test]
    public function shouldReturnValidatorInstanceWhenTheNotRuleIsCalledWithArguments(): void
    {
        $validator = ValidatorBuilder::init();

        // @phpstan-ignore-next-line
        self::assertNotSame($validator, $validator->not($validator->falsy()));
    }

    #[Test]
    public function itShouldProxyResultWithTheIsValidMethod(): void
    {
        $validator = ValidatorBuilder::init(Stub::fail(1));

        self::assertFalse($validator->isValid('whatever'));
    }

    #[Test]
    #[DoesNotPerformAssertions]
    public function itShouldAssertAndNotThrowAnExceptionWhenValidatorPasses(): void
    {
        $validator = ValidatorBuilder::init(Stub::pass(1));
        $validator->assert('whatever');
    }

    #[Test]
    public function itShouldAssertAndThrowAnExceptionWhenValidatorFails(): void
    {
        $this->expectException(ValidationException::class);

        $validator = ValidatorBuilder::init(Stub::fail(1));
        $validator->assert('whatever');
    }

    #[Test]
    public function itShouldAssertUsingTheGivingStringTemplate(): void
    {
        $template = 'This is my new template';

        $this->expectExceptionMessage($template);

        $validator = ValidatorBuilder::init(Stub::fail(1));
        $validator->assert('whatever', $template);
    }

    #[Test]
    public function itShouldValidateAndReturnValidResultQueryWhenValidationPasses(): void
    {
        $validator = ValidatorBuilder::init(Stub::pass(1));

        $resultQuery = $validator->validate('whatever');

        self::assertFalse($resultQuery->hasFailed());
    }

    #[Test]
    public function itShouldValidateAndReturnInvalidResultQueryWhenValidationFails(): void
    {
        $validator = ValidatorBuilder::init(Stub::fail(1));

        $resultQuery = $validator->validate('whatever');

        self::assertTrue($resultQuery->hasFailed());
    }

    #[Test]
    public function itShouldValidateUsingStringTemplateWhenProvided(): void
    {
        $template = uniqid();

        $validator = ValidatorBuilder::init(Stub::fail(1));

        $resultQuery = $validator->validate('whatever', $template);

        self::assertSame($template, $resultQuery->getMessage());
    }

    #[Test]
    public function itShouldValidateUsingArrayTemplatesWhenProvided(): void
    {
        $template = uniqid();

        $validator = ValidatorBuilder::init(Stub::fail(1));

        $resultQuery = $validator->validate('whatever', ['stub' => $template]);

        self::assertSame($template, $resultQuery->getMessage());
    }

    #[Test]
    public function itShouldEvaluateAndThrowExceptionWhenNoValidatorsAreAdded(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('No validators have been added.');

        $validator = ValidatorBuilder::init();
        $validator->evaluate('whatever');
    }

    #[Test]
    public function itShouldEvaluateAndReturnResultWhenOneRuleIsAdded(): void
    {
        $validator = ValidatorBuilder::init(Stub::pass(1));

        $result = $validator->evaluate('whatever');

        self::assertTrue($result->hasPassed);
    }

    #[Test]
    public function itShouldEvaluateAndReturnResultWhenMultipleValidatorsAreAdded(): void
    {
        $validator = ValidatorBuilder::init(Stub::pass(1), Stub::fail(2));

        $result = $validator->evaluate('whatever');

        self::assertFalse($result->hasPassed);
    }

    #[Test]
    public function itShouldEvaluateAndReturnResultWhenSingleFailingRuleIsAdded(): void
    {
        $validator = ValidatorBuilder::init(Stub::fail(1));

        $result = $validator->evaluate('whatever');

        self::assertFalse($result->hasPassed);
    }

    #[Test]
    public function itShouldThrowCustomExceptionWhenPassedToAssertMethod(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Custom exception message');

        ValidatorBuilder::init(Stub::fail(1))
            ->assert('whatever', new InvalidArgumentException('Custom exception message'));
    }

    #[Test]
    public function itShouldThrowCustomExceptionWhenCallableUsedInAssertMethod(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Got: "whatever"');

        ValidatorBuilder::init(Stub::fail(1))
            ->assert('whatever', static fn($e) => new InvalidArgumentException(
                sprintf('Got: %s', $e->getMessage()),
            ));
    }
}
