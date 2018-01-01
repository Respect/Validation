<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Exceptions;

use PHPUnit\Framework\TestCase;

class ValidationExceptionTest extends TestCase
{
    public function testItImplementsExceptionInterface()
    {
        $validationException = new ValidationException();
        self::assertInstanceOf(ExceptionInterface::class, $validationException);
    }

    /**
     * @dataProvider providerForFormat
     */
    public function testFormatShouldReplacePlaceholdersProperly($template, $result, $vars)
    {
        self::assertEquals(
            $result,
            ValidationException::format($template, $vars)
        );
    }

    public function testGetMainMessageShouldApplyTemplatePlaceholders()
    {
        $sampleValidationException = new ValidationException();
        $sampleValidationException->configure('foo', ['bar' => 1, 'baz' => 2]);
        $sampleValidationException->setTemplate('{{name}} {{bar}} {{baz}}');
        self::assertEquals(
            'foo 1 2',
            $sampleValidationException->getMainMessage()
        );
    }

    public function testSettingTemplates()
    {
        $x = new ValidationException();
        $x->configure('bar');
        $x->setTemplate('foo');
        self::assertEquals('foo', $x->getTemplate());
    }

    public function providerForFormat()
    {
        return [
            [
                '{{foo}} {{bar}} {{baz}}',
                '"hello" "world" "respect"',
                ['foo' => 'hello', 'bar' => 'world', 'baz' => 'respect'],
            ],
            [
                '{{foo}} {{bar}} {{baz}}',
                '"hello" {{bar}} "respect"',
                ['foo' => 'hello', 'baz' => 'respect'],
            ],
            [
                '{{foo}} {{bar}} {{baz}}',
                '"hello" {{bar}} "respect"',
                ['foo' => 'hello', 'bot' => 111, 'baz' => 'respect'],
            ],
        ];
    }
}
