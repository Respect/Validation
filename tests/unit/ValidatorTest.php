<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

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
        self::assertSame($validator, $validator->not($validator->notEmpty()));
    }

    #[Test]
    public function itShouldProxyResultWithTheIsValidMethod(): void
    {
        $validator = Validator::create(Stub::fail(1));

        self::assertFalse($validator->isValid('whatever'));
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

    /** @param string|array<string, mixed> $template */
    #[Test]
    #[DataProvider('providerForTemplates')]
    public function itShouldAssertNotOverwritingThePreDefinedTemplate(array|string $template): void
    {
        $preDefinedTemplate = 'This is my pre-defined template';

        $this->expectExceptionMessage($preDefinedTemplate);

        $validator = Validator::create(Stub::fail(1));
        $validator->setTemplate($preDefinedTemplate);
        $validator->assert('whatever', $template);
    }

    /**
     * @return array<string, array{string|array<string, mixed>}>
     */
    public static function providerForTemplates(): array
    {
        return [
            'string' => ['This is my new template'],
            'array key named key' => [['stub' => 'This is my new template']],
            'array key __root__ key' => [['__root__' => 'This is my new template']],
        ];
    }
}
