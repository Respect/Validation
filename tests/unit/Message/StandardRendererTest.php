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
use Respect\Validation\Mode;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\Parameter\TestingProcessor;
use Respect\Validation\Test\TestCase;

use function sprintf;

#[CoversClass(StandardRenderer::class)]
final class StandardRendererTest extends TestCase
{
    #[Test]
    public function itShouldRenderResultWithCustomTemplate(): void
    {
        $renderer = new StandardRenderer(static fn(string $value) => $value, new TestingProcessor());

        $result = (new ResultBuilder())->template('This is my template')->build();

        self::assertSame($result->template, $renderer->render($result));
    }

    #[Test]
    public function itShouldRenderResultOverwritingCustomTemplateWhenTemplateIsPassedAsAnArgument(): void
    {
        $renderer = new StandardRenderer(static fn(string $value) => $value, new TestingProcessor());

        $template = 'This is my brand new template';

        $result = (new ResultBuilder())->template('This is my template')->build();

        self::assertSame($template, $renderer->render($result, $template));
    }

    #[Test]
    public function itShouldRenderResultProcessingParametersInTheTemplate(): void
    {
        $processor = new TestingProcessor();

        $renderer = new StandardRenderer(static fn(string $value) => $value, $processor);

        $key = 'foo';
        $value = 42;

        $result = (new ResultBuilder())
            ->template('Will replace {{foo}}')
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            'Will replace ' . $processor->process($key, $value),
            $renderer->render($result)
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNameAsSomeParameterInTheTemplate(): void
    {
        $processor = new TestingProcessor();

        $renderer = new StandardRenderer(static fn(string $value) => $value, $processor);

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->name('my name')
            ->build();

        self::assertSame(
            'Will replace ' . $processor->process('name', $result->name),
            $renderer->render($result)
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingInputAsNameWhenResultHasNoName(): void
    {
        $processor = new TestingProcessor();

        $renderer = new StandardRenderer(static fn(string $value) => $value, $processor);

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->input(42)
            ->build();

        self::assertSame(
            sprintf(
                'Will replace %s',
                $processor->process('name', $processor->process('input', $result->input))
            ),
            $renderer->render($result)
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingInputAsSomeParameterInTheTemplate(): void
    {
        $processor = new TestingProcessor();

        $renderer = new StandardRenderer(static fn(string $value) => $value, $processor);

        $result = (new ResultBuilder())
            ->template('Will replace {{input}}')
            ->input(42)
            ->build();

        self::assertSame(
            'Will replace ' . $processor->process('input', $result->input),
            $renderer->render($result)
        );
    }

    #[Test]
    public function itShouldRenderResultNotOverwritingNameParameterWithRealName(): void
    {
        $parameterNameValue = 'fake name';

        $processor = new TestingProcessor();

        $renderer = new StandardRenderer(static fn(string $value) => $value, $processor);

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->name('real name')
            ->parameters(['name' => $parameterNameValue])
            ->build();

        self::assertSame(
            'Will replace ' . $processor->process('name', $parameterNameValue),
            $renderer->render($result)
        );
    }

    #[Test]
    public function itShouldRenderResultNotOverwritingInputParameterWithRealInput(): void
    {
        $processor = new TestingProcessor();

        $renderer = new StandardRenderer(static fn(string $value) => $value, $processor);

        $result = (new ResultBuilder())
            ->template('Will replace {{input}}')
            ->input('real input')
            ->parameters(['input' => 'fake input'])
            ->build();

        self::assertSame(
            'Will replace ' . $processor->process('input', 'real input'),
            $renderer->render($result)
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNonExistingParameters(): void
    {
        $renderer = new StandardRenderer(static fn(string $value) => $value, new TestingProcessor());

        $result = (new ResultBuilder())
            ->template('Will not replace {{unknown}}')
            ->build();

        self::assertSame('Will not replace {{unknown}}', $renderer->render($result));
    }

    #[Test]
    public function itShouldRenderResultTranslatingTemplate(): void
    {
        $template = 'This is my template with {{foo}}';
        $translations = [$template => 'This is my translated template with {{foo}}'];

        $renderer = new StandardRenderer(
            static fn(string $value) => $translations[$value],
            new TestingProcessor()
        );

        $result = (new ResultBuilder())
            ->template($template)
            ->build();

        self::assertSame($translations[$template], $renderer->render($result));
    }

    #[Test]
    public function itShouldThrowAnExceptionWhenTranslatorDoesNotWork(): void
    {
        $renderer = new StandardRenderer(
            static fn(string $value) => throw new Exception(),
            new TestingProcessor()
        );

        $result = (new ResultBuilder())->template('Template')->build();

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage(sprintf('Failed to translate "%s"', $result->template));

        $renderer->render($result);
    }

    #[Test]
    public function itShouldRenderResultWithTemplateAttachedToRule(): void
    {
        $processor = new TestingProcessor();
        $renderer = new StandardRenderer(static fn(string $value) => $value, $processor);

        $result = (new ResultBuilder())->build();

        self::assertSame(
            sprintf(
                '%s must be a valid stub',
                $processor->process('name', $processor->process('input', $result->input))
            ),
            $renderer->render($result)
        );
    }

    #[Test]
    public function itShouldRenderResultWithTemplateAttachedToRuleWithInvertedMode(): void
    {
        $processor = new TestingProcessor();
        $renderer = new StandardRenderer(static fn(string $value) => $value, $processor);

        $result = (new ResultBuilder())->mode(Mode::INVERTED)->build();

        self::assertSame(
            sprintf(
                '%s must not be a valid stub',
                $processor->process('name', $processor->process('input', $result->input))
            ),
            $renderer->render($result)
        );
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplateWhenCannotFindAttachedTemplate(): void
    {
        $processor = new TestingProcessor();
        $renderer = new StandardRenderer(static fn(string $value) => $value, $processor);

        $result = (new ResultBuilder())->template('__not_standard__')->mode(Mode::INVERTED)->build();

        self::assertSame(
            $result->template,
            $renderer->render($result)
        );
    }

    #[Test]
    public function itShouldRenderResultWithItsSiblingsWhenItHasNoCustomTemplate(): void
    {
        $renderer = new StandardRenderer(static fn(string $value) => $value, new TestingProcessor());

        $result = (new ResultBuilder())->template('__1st__')
            ->nextSibling(
                (new ResultBuilder())->template('__2nd__')
                    ->nextSibling(
                        (new ResultBuilder())->template('__3rd__')->build(),
                    )
                    ->build(),
            )
            ->build();

        $expect = '__1st__ __2nd__ __3rd__';

        self::assertSame($expect, $renderer->render($result));
    }

    #[Test]
    public function itShouldRenderResultWithoutItsSiblingsWhenItHasCustomTemplate(): void
    {
        $template = 'Custom template';

        $result = (new ResultBuilder())->template($template)
            ->nextSibling((new ResultBuilder())->template('and this is a sibling')->build())
            ->build();

        $renderer = new StandardRenderer(static fn(string $value) => $value, new TestingProcessor());

        self::assertSame($template, $renderer->render($result));
    }
}
