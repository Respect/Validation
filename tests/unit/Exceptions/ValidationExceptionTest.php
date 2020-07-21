<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;
use Respect\Validation\Test\TestCase;

use function trim;

/**
 * @group core
 * @covers \Respect\Validation\Exceptions\ValidationException
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Andy Wendt <andy@awendt.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ValidationExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldImplementException(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());

        self::assertInstanceOf(Exception::class, $sut);
    }

    /**
     * @test
     */
    public function itShouldRetrieveId(): void
    {
        $id = 'my id';
        $sut = new ValidationException('input', $id, [], $this->createFormatter());

        self::assertSame($id, $sut->getId());
    }

    /**
     * @test
     */
    public function itShouldRetrieveParams(): void
    {
        $params = ['foo' => true, 'bar' => 23];

        $sut = new ValidationException('input', 'id', $params, $this->createFormatter());

        self::assertSame($params, $sut->getParams());
    }

    /**
     * @test
     */
    public function itShouldRetrieveOneSingleParameter(): void
    {
        $name = 'any name';
        $value = 'any value';

        $sut = new ValidationException('input', 'id', [$name => $value], $this->createFormatter());

        self::assertSame($value, $sut->getParam($name));
    }

    /**
     * @test
     */
    public function itShouldReturnNullWhenParameterCanNotBeFound(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());

        self::assertNull($sut->getParam('foo'));
    }

    /**
     * @test
     */
    public function itShouldHaveTemplateByDefault(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());

        self::assertSame('"input" must be valid', $sut->getMessage());
    }

    /**
     * @test
     */
    public function itShouldUpdateMode(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());
        $sut->updateMode(ValidationException::MODE_NEGATIVE);

        self::assertSame('"input" must not be valid', $sut->getMessage());
    }

    /**
     * @test
     */
    public function itShouldUpdateTemplate(): void
    {
        $template = 'This is my new template';

        $sut = new ValidationException('input', 'id', [], $this->createFormatter());
        $sut->updateTemplate($template);

        self::assertEquals($template, $sut->getMessage());
    }

    /**
     * @test
     */
    public function itShouldTellWhenHasAsCustomUpdateTemplate(): void
    {
        $sut = new ValidationException('input', 'id', [], $this->createFormatter());

        self::assertFalse($sut->hasCustomTemplate());

        $sut->updateTemplate('This is my new template');

        self::assertTrue($sut->hasCustomTemplate());
    }

    /**
     * @test
     */
    public function itShouldUseFormatter(): void
    {
        $template = ' This is my new template ';
        $expected = trim($template);

        $sut = new ValidationException('input', 'id', [], new Formatter('trim', new KeepOriginalStringName()));
        $sut->updateTemplate($template);

        self::assertEquals($expected, $sut->getMessage());
    }

    /**
     * @test
     */
    public function itShouldReplacePlaceholders(): void
    {
        $sut = new ValidationException('foo', 'id', ['bar' => 1, 'baz' => 2], $this->createFormatter());
        $sut->updateTemplate('{{name}} {{bar}} {{baz}}');

        self::assertEquals(
            '"foo" 1 2',
            $sut->getMessage()
        );
    }

    /**
     * @test
     */
    public function itShouldKeepPlaceholdersThatCanNotReplace(): void
    {
        $sut = new ValidationException('foo', 'id', ['foo' => 1], $this->createFormatter());
        $sut->updateTemplate('{{name}} {{foo}} {{bar}}');

        self::assertEquals(
            '"foo" 1 {{bar}}',
            $sut->getMessage()
        );
    }

    /**
     * @test
     */
    public function itShouldUpdateParams(): void
    {
        $sut = new ValidationException('input', 'id', ['foo' => 1], $this->createFormatter());
        $sut->updateTemplate('{{foo}}');
        $sut->updateParams(['foo' => 2]);

        self::assertEquals('2', $sut->getMessage());
    }

    /**
     * @test
     */
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
