<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\Message\TestingParameterStringifier;
use Respect\Validation\Test\TestCase;
use stdClass;

use function sprintf;

#[CoversClass(TemplateRenderer::class)]
final class TemplateRendererTest extends TestCase
{
    #[Test]
    public function itShouldRenderMessageWithItsTemplate(): void
    {
        $renderer = new TemplateRenderer(static fn(string $value) => $value, new TestingParameterStringifier());

        $template = 'This is my template';

        self::assertSame($template, $renderer->render($template, 'input', []));
    }

    #[Test]
    public function itShouldReplaceParameters(): void
    {
        $parameterStringifier = new TestingParameterStringifier();

        $renderer = new TemplateRenderer(static fn(string $value) => $value, $parameterStringifier);

        $key = 'foo';
        $value = 42;

        $expected = 'Will replace ' . $parameterStringifier->stringify($key, $value);
        $actual = $renderer->render('Will replace {{foo}}', 'input', [$key => $value]);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldReplaceNameWithStringifiedInputWhenThereIsNoName(): void
    {
        $parameterStringifier = new TestingParameterStringifier();

        $renderer = new TemplateRenderer(static fn(string $value) => $value, $parameterStringifier);

        $message = 'Will replace {{name}}';
        $input = 'input';

        $expected = 'Will replace ' . $parameterStringifier->stringify(
            'name',
            $parameterStringifier->stringify('input', $input),
        );
        $actual = $renderer->render($message, $input, []);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldKeepNameWhenDefined(): void
    {
        $parameterStringifier = new TestingParameterStringifier();

        $renderer = new TemplateRenderer(static fn(string $value) => $value, $parameterStringifier);

        $name = 'real name';

        $expected = 'Will replace ' . $parameterStringifier->stringify('name', $name);
        $actual = $renderer->render('Will replace {{name}}', 'input', ['name' => $name]);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldKeepUnknownParameters(): void
    {
        $renderer = new TemplateRenderer(static fn(string $value) => $value, new TestingParameterStringifier());

        $expected = 'Will not replace {{unknown}}';
        $actual = $renderer->render($expected, 'input', []);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldRenderTranslateTemplate(): void
    {
        $template = 'This is my template with {{foo}}';
        $translations = [$template => 'This is my translated template with {{foo}}'];

        $renderer = new TemplateRenderer(
            static fn(string $value) => $translations[$value],
            new TestingParameterStringifier()
        );

        $expected = $translations[$template];
        $actual = $renderer->render($template, 'input', []);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldThrowAnExceptionWhenTranslateThrowsAnException(): void
    {
        $template = 'This is my template';

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage(sprintf('Failed to translate "%s"', $template));

        $renderer = new TemplateRenderer(
            static fn(string $value) => throw new Exception(),
            new TestingParameterStringifier()
        );
        $renderer->render($template, 'input', []);
    }

    #[Test]
    public function itShouldRenderTranslateParameter(): void
    {
        $parameterOriginal = 'original';
        $parameterTranslated = 'translated';

        $template = 'This is my template with {{foo|trans}}';

        $translations = [
            $parameterOriginal => $parameterTranslated,
            $template => 'This is my translated template with {{foo|trans}}',
        ];

        $renderer = new TemplateRenderer(
            static fn(string $value) => $translations[$value],
            new TestingParameterStringifier()
        );

        $parameters = ['foo' => $parameterOriginal];

        $expected = 'This is my translated template with translated';
        $actual = $renderer->render($template, 'input', $parameters);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldThrowAnExceptionWhenTranslateParameterIsNotScalar(): void
    {
        $parameterValue = new stdClass();

        $template = 'This is my template with {{foo|trans}}';

        $renderer = new TemplateRenderer(static fn(string $value) => $value, new TestingParameterStringifier());

        $this->expectException(ComponentException::class);

        $renderer->render($template, 'input', ['foo' => $parameterValue]);
    }

    #[Test]
    public function itShouldRenderRawParameter(): void
    {
        $raw = 'raw';

        $template = 'This is my template with {{foo|raw}}';

        $renderer = new TemplateRenderer(static fn(string $value) => $value, new TestingParameterStringifier());

        $expected = 'This is my template with raw';
        $actual = $renderer->render($template, 'input', ['foo' => $raw]);

        self::assertSame($expected, $actual);
    }
}
