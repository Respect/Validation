<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use PHPUnit\Framework\TestCase;

/**
 * @group core
 * @covers \Respect\Validation\Exceptions\ValidationException
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ValidationExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldImplementException(): void
    {
        $sut = new ValidationException('input', 'id', [], 'trim');

        self::assertInstanceOf(Exception::class, $sut);
    }

    /**
     * @test
     */
    public function itShouldRetrieveId(): void
    {
        $id = 'my id';
        $sut = new ValidationException('input', $id, [], 'trim');

        self::assertSame($id, $sut->getId());
    }

    /**
     * @test
     */
    public function itShouldRetrieveParams(): void
    {
        $params = ['foo' => true, 'bar' => 23];

        $sut = new ValidationException('input', 'id', $params, 'trim');

        self::assertSame($params, $sut->getParams());
    }

    /**
     * @test
     */
    public function itShouldRetrieveASingleParameter(): void
    {
        $name = 'any name';
        $value = 'any value';

        $sut = new ValidationException('input', 'id', [$name => $value], 'trim');

        self::assertSame($value, $sut->getParam($name));
    }

    /**
     * @test
     */
    public function itShouldReturnNullWhenParameterCanNotBeFound(): void
    {
        $sut = new ValidationException('input', 'id', [], 'trim');

        self::assertNull($sut->getParam('foo'));
    }

    /**
     * @test
     */
    public function itShouldHaveADefaultTemplate(): void
    {
        $sut = new ValidationException('input', 'id', [], 'trim');

        self::assertSame('"input" must be valid', $sut->getMessage());
    }

    /**
     * @test
     */
    public function itShouldUpdateMode(): void
    {
        $sut = new ValidationException('input', 'id', [], 'trim');
        $sut->updateMode(ValidationException::MODE_NEGATIVE);

        self::assertSame('"input" must not be valid', $sut->getMessage());
    }

    /**
     * @test
     */
    public function itShouldUpdateTemplate(): void
    {
        $template = 'This is my new template';

        $sut = new ValidationException('input', 'id', [], 'trim');
        $sut->updateTemplate($template);

        self::assertEquals($template, $sut->getMessage());
    }

    /**
     * @test
     */
    public function itShouldTellWhenHasAsCustomUpdateTemplate(): void
    {
        $sut = new ValidationException('input', 'id', [], 'trim');

        self::assertFalse($sut->hasCustomTemplate());

        $sut->updateTemplate('This is my new template');

        self::assertTrue($sut->hasCustomTemplate());
    }

    /**
     * @test
     */
    public function itShouldUseTranslator(): void
    {
        $template = ' This is my new template ';
        $expected = trim($template);

        $sut = new ValidationException('input', 'id', [], 'trim');
        $sut->updateTemplate($template);

        self::assertEquals($expected, $sut->getMessage());
    }

    /**
     * @test
     */
    public function itShouldReplacePlaceholders(): void
    {
        $sut = new ValidationException('foo', 'id', ['bar' => 1, 'baz' => 2], 'trim');
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
        $sut = new ValidationException('foo', 'id', ['foo' => 1], 'trim');
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
        $sut = new ValidationException('input', 'id', ['foo' => 1], 'trim');
        $sut->updateTemplate('{{foo}}');
        $sut->updateParams(['foo' => 2]);

        self::assertEquals('2', $sut->getMessage());
    }

    /**
     * @test
     */
    public function itShouldConvertToString(): void
    {
        $sut = new ValidationException('input', 'id', [], 'trim');

        self::assertSame('"input" must be valid', (string) $sut);
    }
}
