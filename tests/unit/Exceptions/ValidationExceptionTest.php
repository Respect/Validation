<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;
use Respect\Validation\Message\Template;
use Respect\Validation\Message\TemplateRenderer;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;

use function trim;

#[Group('core')]
#[CoversClass(ValidationException::class)]
final class ValidationExceptionTest extends TestCase
{
    #[Test]
    public function itShouldImplementException(): void
    {
        $sut = $this->createValidationException();

        self::assertInstanceOf(Exception::class, $sut);
    }

    #[Test]
    public function itShouldRetrieveId(): void
    {
        $id = 'my id';
        $sut = $this->createValidationException(id: $id);

        self::assertSame($id, $sut->getId());
    }

    #[Test]
    public function itShouldRetrieveParams(): void
    {
        $params = ['foo' => true, 'bar' => 23];

        $sut = $this->createValidationException(params: $params);

        self::assertSame($params, $sut->getParams());
    }

    #[Test]
    public function itShouldRetrieveOneSingleParameter(): void
    {
        $name = 'any name';
        $value = 'any value';

        $sut = $this->createValidationException(params: [$name => $value]);

        self::assertSame($value, $sut->getParam($name));
    }

    #[Test]
    public function itShouldReturnNullWhenParameterCanNotBeFound(): void
    {
        $sut = $this->createValidationException();

        self::assertNull($sut->getParam('foo'));
    }

    #[Test]
    public function itShouldUpdateMode(): void
    {
        $sut = $this->createValidationException();
        $sut->updateMode(ValidationException::MODE_NEGATIVE);

        self::assertSame('"input" must not be valid', $sut->getMessage());
    }

    #[Test]
    public function itShouldUpdateTemplate(): void
    {
        $template = 'This is my new template';

        $sut = $this->createValidationException();
        $sut->updateTemplate($template);

        self::assertEquals($template, $sut->getMessage());
    }

    #[Test]
    public function itShouldTellWhenHasAsCustomUpdateTemplate(): void
    {
        $sut = $this->createValidationException();

        self::assertFalse($sut->hasCustomTemplate());

        $sut->updateTemplate('This is my new template');

        self::assertTrue($sut->hasCustomTemplate());
    }

    #[Test]
    public function itShouldUseFormatter(): void
    {
        $template = ' This is my new template ';
        $expected = trim($template);

        $sut = $this->createValidationException(formatter: new TemplateRenderer('trim', new KeepOriginalStringName()));
        $sut->updateTemplate($template);

        self::assertEquals($expected, $sut->getMessage());
    }

    #[Test]
    public function itShouldReplacePlaceholders(): void
    {
        $sut = $this->createValidationException(params: ['bar' => 1, 'baz' => 2]);
        $sut->updateTemplate('{{name}} {{bar}} {{baz}}');

        self::assertEquals(
            '"input" 1 2',
            $sut->getMessage()
        );
    }

    #[Test]
    public function itShouldKeepPlaceholdersThatCanNotReplace(): void
    {
        $sut = $this->createValidationException(params: ['foo' => 1]);
        $sut->updateTemplate('{{name}} {{foo}} {{bar}}');

        self::assertEquals(
            '"input" 1 {{bar}}',
            $sut->getMessage()
        );
    }

    #[Test]
    public function itShouldUpdateParams(): void
    {
        $sut = $this->createValidationException(params: ['foo' => 1]);
        $sut->updateTemplate('{{foo}}');
        $sut->updateParams(['foo' => 2]);

        self::assertEquals('2', $sut->getMessage());
    }

    #[Test]
    public function itShouldConvertToString(): void
    {
        $sut = $this->createValidationException();

        self::assertSame('"input" must be valid', (string) $sut);
    }

    /**
     * @param array<string, mixed> $params
     * @param array<Template> $templates
     */
    private function createValidationException(
        mixed $input = 'input',
        string $id = 'id',
        array $params = [],
        string $template = Validatable::TEMPLATE_STANDARD,
        array $templates = [],
        TemplateRenderer $formatter = new TemplateRenderer('strval', new KeepOriginalStringName())
    ): ValidationException {
        return new ValidationException($input, $id, $params, $template, $templates, $formatter);
    }
}
