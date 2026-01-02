<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

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
    public function itShouldValidateUsingPreDefinedTemplatesFromSetTemplates(): void
    {
        $template = uniqid();

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplates(['stub' => $template]);

        $resultQuery = $validator->validate('whatever');

        self::assertSame($template, $resultQuery->toMessage());
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

    #[Test]
    public function itShouldEvaluateAndThrowExceptionWhenNoRulesAreAdded(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('No rules have been added to this validator.');

        $validator = Validator::create();
        $validator->evaluate('whatever');
    }

    #[Test]
    public function itShouldEvaluateAndReturnResultWhenOneRuleIsAdded(): void
    {
        $validator = Validator::create(Stub::pass(1));

        $result = $validator->evaluate('whatever');

        self::assertTrue($result->hasPassed);
    }

    #[Test]
    public function itShouldEvaluateAndReturnResultWhenMultipleRulesAreAdded(): void
    {
        $validator = Validator::create(Stub::pass(1), Stub::fail(2));

        $result = $validator->evaluate('whatever');

        self::assertFalse($result->hasPassed);
    }

    #[Test]
    public function itShouldEvaluateAndReturnResultWhenSingleFailingRuleIsAdded(): void
    {
        $validator = Validator::create(Stub::fail(1));

        $result = $validator->evaluate('whatever');

        self::assertFalse($result->hasPassed);
    }
}
