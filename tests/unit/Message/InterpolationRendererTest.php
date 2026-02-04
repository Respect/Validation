<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\StringFormatter\PlaceholderFormatter;
use Respect\Validation\Message\Formatter\TemplateResolver;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingTranslator;
use Respect\Validation\Test\TestCase;

#[CoversClass(InterpolationRenderer::class)]
final class InterpolationRendererTest extends TestCase
{
    #[Test]
    public function itShouldRenderResultWithCustomTemplate(): void
    {
        $renderer = new InterpolationRenderer(
            new TestingTranslator(),
            new PlaceholderFormatter([]),
            new TemplateResolver(new TemplateRegistry()),
        );

        $result = (new ResultBuilder())->template('This is my template')->build();

        self::assertSame($result->template, $renderer->render($result, []));
    }

    #[Test]
    public function itShouldRenderResultProcessingParametersFromTheResult(): void
    {
        $parameters = ['foo' => 42];
        $template = 'Value: {{foo}}';
        $formatter = new PlaceholderFormatter([]);
        $expected = $formatter->formatUsing($template, $parameters);
        $result = (new ResultBuilder())
            ->template($template)
            ->parameters($parameters)
            ->build();
        $renderer = new InterpolationRenderer(
            new TestingTranslator(),
            $formatter,
            new TemplateResolver(new TemplateRegistry()),
        );

        $actual = $renderer->render($result, []);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldRenderResultWithInputParameter(): void
    {
        $template = 'Input: {{input}}';
        $input = 'test input';
        $formatter = new PlaceholderFormatter([]);
        $expected = $formatter->formatUsing($template, ['input' => $input]);
        $result = (new ResultBuilder())
            ->template($template)
            ->input($input)
            ->build();
        $renderer = new InterpolationRenderer(
            new TestingTranslator(),
            $formatter,
            new TemplateResolver(new TemplateRegistry()),
        );

        $actual = $renderer->render($result, []);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldRenderResultWithSubjectParameter(): void
    {
        $template = 'Subject: {{subject}}';
        $subject = 'test';
        $formatter = new PlaceholderFormatter([]);
        $result = (new ResultBuilder())
            ->template($template)
            ->input($subject)
            ->build();
        $expected = $formatter->formatUsing($template, ['subject' => $result]);
        $renderer = new InterpolationRenderer(
            new TestingTranslator(),
            $formatter,
            new TemplateResolver(new TemplateRegistry()),
        );

        $actual = $renderer->render($result, []);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldRenderResultWithPathParameter(): void
    {
        $template = 'Path: {{path}}';
        $formatter = new PlaceholderFormatter([]);
        $result = (new ResultBuilder())
            ->template($template)
            ->build();
        $expected = $formatter->formatUsing($template, ['path' => $result->path]);
        $renderer = new InterpolationRenderer(
            new TestingTranslator(),
            $formatter,
            new TemplateResolver(new TemplateRegistry()),
        );

        $actual = $renderer->render($result, []);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldNotAllowParametersToOverrideDefaultOnes(): void
    {
        $template = 'Input: {{input}}';
        $input = 'real input';
        $parameters = ['input' => 'custom input'];
        $formatter = new PlaceholderFormatter([]);
        $expected = $formatter->formatUsing($template, ['input' => $input]);
        $result = (new ResultBuilder())
            ->template($template)
            ->input($input)
            ->parameters($parameters)
            ->build();
        $renderer = new InterpolationRenderer(
            new TestingTranslator(),
            $formatter,
            new TemplateResolver(new TemplateRegistry()),
        );

        $actual = $renderer->render($result, []);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldRenderResultTranslatingTemplate(): void
    {
        $template = 'Original message {{name}}';
        $translations = [$template => 'Translated message {{name}}'];
        $translator = new TestingTranslator($translations);
        $formatter = new PlaceholderFormatter([]);
        $expected = $formatter->formatUsing($translations[$template], []);
        $result = (new ResultBuilder())
            ->template($template)
            ->build();
        $renderer = new InterpolationRenderer($translator, $formatter, new TemplateResolver(new TemplateRegistry()));

        $actual = $renderer->render($result, []);

        self::assertSame($expected, $actual);
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplate(): void
    {
        $renderer = new InterpolationRenderer(
            new TestingTranslator(),
            new PlaceholderFormatter([]),
            new TemplateResolver(new TemplateRegistry()),
        );

        $result = (new ResultBuilder())->build();

        $output = $renderer->render($result, []);

        self::assertStringContainsString('must be a valid stub', $output);
    }

    #[Test]
    public function itShouldRenderResultWithInvertedMode(): void
    {
        $renderer = new InterpolationRenderer(
            new TestingTranslator(),
            new PlaceholderFormatter([]),
            new TemplateResolver(new TemplateRegistry()),
        );

        $result = (new ResultBuilder())->hasInvertedMode()->build();

        $output = $renderer->render($result, []);

        self::assertStringContainsString('must not be a valid stub', $output);
    }

    #[Test]
    public function itShouldRenderResultWithItsAdjacentWhenItHasNoCustomTemplate(): void
    {
        $renderer = new InterpolationRenderer(
            new TestingTranslator(),
            new PlaceholderFormatter([]),
            new TemplateResolver(new TemplateRegistry()),
        );

        $result = (new ResultBuilder())->template('__1st__')
            ->adjacent(
                (new ResultBuilder())->template('__2nd__')
                    ->adjacent(
                        (new ResultBuilder())->template('__3rd__')->build(),
                    )
                    ->build(),
            )
            ->build();

        $expect = '__1st__ __2nd__ __3rd__';

        self::assertSame($expect, $renderer->render($result, []));
    }

    #[Test]
    public function itShouldNotRenderAdjacentsWhenItHasCustomTemplate(): void
    {
        $template = 'Custom template';

        $renderer = new InterpolationRenderer(
            new TestingTranslator(),
            new PlaceholderFormatter([]),
            new TemplateResolver(new TemplateRegistry()),
        );

        $result = (new ResultBuilder())->template($template)
            ->adjacent((new ResultBuilder())->template('and this is a adjacent')->build())
            ->build();

        self::assertSame($template, $renderer->render($result, []));
    }
}
