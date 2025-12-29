<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;
use Throwable;

use function uniqid;

#[CoversClass(Validator::class)]
final class ValidatorTest extends TestCase
{
    #[Test]
    public function invalidRuleClassShouldThrowComponentException(): void
    {
        $this->expectException(ComponentException::class);

        // @phpstan-ignore-next-line
        Validator::iDoNotExistSoIShouldThrowException();
    }

    #[Test]
    public function shouldReturnValidatorInstanceWhenTheNotRuleIsCalledWithArguments(): void
    {
        $validator = Validator::create();

        // @phpstan-ignore-next-line
        self::assertSame($validator, $validator->not($validator->falsy()));
    }

    #[Test]
    public function itShouldProxyResultWithTheIsValidMethod(): void
    {
        $validator = Validator::create(Stub::fail(1));

        self::assertFalse($validator->isValid('whatever'));
    }

    #[Test]
    #[DoesNotPerformAssertions]
    public function itShouldAssertAndNotThrowAnExceptionWhenValidatorPasses(): void
    {
        $validator = Validator::create(Stub::pass(1));
        $validator->assert('whatever');
    }

    #[Test]
    public function itShouldAssertAndThrowAnExceptionWhenValidatorFails(): void
    {
        $this->expectException(ValidationException::class);

        $validator = Validator::create(Stub::fail(1));
        $validator->assert('whatever');
    }

    #[Test]
    public function itShouldAssertUsingThePreDefinedTemplatesInTheChain(): void
    {
        $templates = ['stub' => 'This is my pre-defined template'];

        $this->expectExceptionMessage($templates['stub']);

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplates($templates);
        $validator->assert('whatever');
    }

    #[Test]
    public function itShouldAssertUsingThePreDefinedTemplateInTheChain(): void
    {
        $template = 'This is my pre-defined template';

        $this->expectExceptionMessage($template);

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplate($template);
        $validator->assert('whatever');
    }

    #[Test]
    public function itShouldAssertUsingTheGivingCallableEvenWhenRuleAlreadyHasTemplate(): void
    {
        $predefinedTemplate = 'Current template';

        $template = static fn(Throwable $exception) => new Exception('My exception: ' . $exception->getMessage());

        $this->expectExceptionMessage('My exception: ' . $predefinedTemplate);

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplate($predefinedTemplate);
        $validator->assert('whatever', $template);
    }

    #[Test]
    public function itShouldAssertUsingTheGivingExceptionEvenWhenRuleAlreadyHasTemplate(): void
    {
        $template = new Exception('This is a test');

        $this->expectExceptionObject($template);

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplate('This wont be used');
        $validator->assert('whatever', $template);
    }

    #[Test]
    public function itShouldAssertUsingTheGivingStringTemplate(): void
    {
        $template = 'This is my new template';

        $this->expectExceptionMessage($template);

        $validator = Validator::create(Stub::fail(1));
        $validator->assert('whatever', $template);
    }

    #[Test]
    public function itShouldAssertUsingTheGivingArrayTemplateWithTheRuleNameAsKey(): void
    {
        $template = ['stub' => 'This is my new template'];

        $this->expectExceptionMessage($template['stub']);

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplates(['stub' => 'This is my pre-defined template']);
        $validator->assert('whatever', $template);
    }

    #[Test]
    public function itShouldAssertUsingTheGivingArrayTemplateWithRootKey(): void
    {
        $template = ['__root__' => 'This is my new template'];

        $this->expectExceptionMessage($template['__root__']);

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplates(['__root__' => 'This is my pre-defined template']);
        $validator->assert('whatever', $template);
    }

    #[Test]
    public function itShouldValidateAndReturnValidResultQueryWhenValidationPasses(): void
    {
        $validator = Validator::create(Stub::pass(1));

        $resultQuery = $validator->validate('whatever');

        self::assertTrue($resultQuery->isValid());
    }

    #[Test]
    public function itShouldValidateAndReturnInvalidResultQueryWhenValidationFails(): void
    {
        $validator = Validator::create(Stub::fail(1));

        $resultQuery = $validator->validate('whatever');

        self::assertFalse($resultQuery->isValid());
    }

    #[Test]
    public function itShouldValidateUsingStringTemplateWhenProvided(): void
    {
        $template = uniqid();

        $validator = Validator::create(Stub::fail(1));

        $resultQuery = $validator->validate('whatever', $template);

        self::assertSame($template, $resultQuery->toMessage());
    }

    #[Test]
    public function itShouldValidateUsingArrayTemplatesWhenProvided(): void
    {
        $template = uniqid();

        $validator = Validator::create(Stub::fail(1));

        $resultQuery = $validator->validate('whatever', ['stub' => $template]);

        self::assertSame($template, $resultQuery->toMessage());
    }

    #[Test]
    public function itShouldValidateUsingPreDefinedTemplateFromSetTemplate(): void
    {
        $template = uniqid();

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplate($template);

        $resultQuery = $validator->validate('whatever');

        self::assertSame($template, $resultQuery->toMessage());
    }

    #[Test]
    public function itShouldValidateUsingPreDefinedTemplatesFromSetTemplates(): void
    {
        $template = uniqid();

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplates(['stub' => $template]);

        $resultQuery = $validator->validate('whatever');

        self::assertSame($template, $resultQuery->toMessage());
    }

    #[Test]
    public function itShouldValidateOverridingPreDefinedTemplateWithStringTemplate(): void
    {
        $overrideTemplate = uniqid();

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplate('This should be overridden');

        $resultQuery = $validator->validate('whatever', $overrideTemplate);

        self::assertSame($overrideTemplate, $resultQuery->toMessage());
    }

    #[Test]
    public function itShouldValidateOverridingPreDefinedTemplatesWithArrayTemplates(): void
    {
        $overrideTemplate = uniqid();

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplates(['stub' => 'This should be overridden']);

        $resultQuery = $validator->validate('whatever', ['stub' => $overrideTemplate]);

        self::assertSame($overrideTemplate, $resultQuery->toMessage());
    }
}
