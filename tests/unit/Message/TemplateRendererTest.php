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
use Respect\Validation\Test\Message\Parameter\TestingProcessor;
use Respect\Validation\Test\TestCase;

use function sprintf;

#[CoversClass(TemplateRenderer::class)]
final class TemplateRendererTest extends TestCase
{
    #[Test]
    public function itShouldRenderMessageWithItsTemplate(): void
    {
        $renderer = new TemplateRenderer(static fn(string $value) => $value, new TestingProcessor());

        $template = 'This is my template';

        self::assertSame($template, $renderer->render($template, 'input', []));
    }

    #[Test]
    public function itShouldReplaceParameters(): void
    {
        $parameterStringifier = new TestingProcessor();

        $renderer = new TemplateRenderer(static fn(string $value) => $value, $parameterStringifier);

        $key = 'foo';
        $value = 42;

        $expected = 'Will replace ' . $parameterStringifier->process($key, $value, null);
        $actual = $renderer->render('Will replace {{foo}}', 'input', [$key => $value]);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldReplaceNameWithStringifiedInputWhenThereIsNoName(): void
    {
        $parameterStringifier = new TestingProcessor();

        $renderer = new TemplateRenderer(static fn(string $value) => $value, $parameterStringifier);

        $message = 'Will replace {{name}}';
        $input = 'input';

        $expected = 'Will replace ' . $parameterStringifier->process(
            'name',
            $parameterStringifier->process('input', $input, null),
            null,
        );
        $actual = $renderer->render($message, $input, []);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldKeepNameWhenDefined(): void
    {
        $parameterStringifier = new TestingProcessor();

        $renderer = new TemplateRenderer(static fn(string $value) => $value, $parameterStringifier);

        $name = 'real name';

        $expected = 'Will replace ' . $parameterStringifier->process('name', $name, null);
        $actual = $renderer->render('Will replace {{name}}', 'input', ['name' => $name]);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldKeepUnknownParameters(): void
    {
        $renderer = new TemplateRenderer(static fn(string $value) => $value, new TestingProcessor());

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
            new TestingProcessor()
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
            new TestingProcessor()
        );
        $renderer->render($template, 'input', []);
    }
}
