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
use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;
use Respect\Validation\Test\TestCase;

use function trim;

#[Group('core')]
#[CoversClass(ValidationException::class)]
final class ValidationExceptionTest extends TestCase
{
    #[Test]
    public function itShouldImplementException(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());

        self::assertInstanceOf(Exception::class, $sut);
    }

    #[Test]
    public function itShouldRetrieveId(): void
    {
        $id = 'my id';
        $sut = new ValidationException('input', $id, [], $this->createFormatter());

        self::assertSame($id, $sut->getId());
    }

    #[Test]
    public function itShouldRetrieveParams(): void
    {
        $params = ['foo' => true, 'bar' => 23];

        $sut = new ValidationException('input', 'id', $params, $this->createFormatter());

        self::assertSame($params, $sut->getParams());
    }

    #[Test]
    public function itShouldRetrieveOneSingleParameter(): void
    {
        $name = 'any name';
        $value = 'any value';

        $sut = new ValidationException('input', 'id', [$name => $value], $this->createFormatter());

        self::assertSame($value, $sut->getParam($name));
    }

    #[Test]
    public function itShouldReturnNullWhenParameterCanNotBeFound(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());

        self::assertNull($sut->getParam('foo'));
    }

    #[Test]
    public function itShouldHaveTemplateByDefault(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());

        self::assertSame('"input" must be valid', $sut->getMessage());
    }

    #[Test]
    public function itShouldUpdateMode(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());
        $sut->updateMode(ValidationException::MODE_NEGATIVE);

        self::assertSame('"input" must not be valid', $sut->getMessage());
    }

    #[Test]
    public function itShouldUpdateTemplate(): void
    {
        $template = 'This is my new template';

        $sut = new ValidationException('input', 'id', [], $this->createFormatter());
        $sut->updateTemplate($template);

        self::assertEquals($template, $sut->getMessage());
    }

    #[Test]
    public function itShouldTellWhenHasAsCustomUpdateTemplate(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());

        self::assertFalse($sut->hasCustomTemplate());

        $sut->updateTemplate('This is my new template');

        self::assertTrue($sut->hasCustomTemplate());
    }

    #[Test]
    public function itShouldUseFormatter(): void
    {
        $template = ' This is my new template ';
        $expected = trim($template);

        $sut = new ValidationException('input', 'id', [], new Formatter('trim', new KeepOriginalStringName()));
        $sut->updateTemplate($template);

        self::assertEquals($expected, $sut->getMessage());
    }

    #[Test]
    public function itShouldReplacePlaceholders(): void
    {
        $sut = new ValidationException('foo', 'id', ['bar' => 1, 'baz' => 2], $this->createFormatter());
        $sut->updateTemplate('{{name}} {{bar}} {{baz}}');

        self::assertEquals(
            '"foo" 1 2',
            $sut->getMessage()
        );
    }

    #[Test]
    public function itShouldKeepPlaceholdersThatCanNotReplace(): void
    {
        $sut = new ValidationException('foo', 'id', ['foo' => 1], $this->createFormatter());
        $sut->updateTemplate('{{name}} {{foo}} {{bar}}');

        self::assertEquals(
            '"foo" 1 {{bar}}',
            $sut->getMessage()
        );
    }

    #[Test]
    public function itShouldUpdateParams(): void
    {
        $sut = new ValidationException('input', 'id', ['foo' => 1], $this->createFormatter());
        $sut->updateTemplate('{{foo}}');
        $sut->updateParams(['foo' => 2]);

        self::assertEquals('2', $sut->getMessage());
    }

    #[Test]
    public function itShouldConvertToString(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());

        self::assertSame('"input" must be valid', (string) $sut);
    }

    private function createFormatter(): Formatter
    {
        return new Formatter('strval', new KeepOriginalStringName());
    }
}
