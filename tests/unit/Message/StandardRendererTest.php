<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\Translator\ArrayTranslator;
use Respect\Validation\Message\Translator\DummyTranslator;
use Respect\Validation\Mode;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingStringifier;
use Respect\Validation\Test\TestCase;

use function sprintf;

#[CoversClass(StandardRenderer::class)]
final class StandardRendererTest extends TestCase
{
    #[Test]
    public function itShouldRenderResultWithCustomTemplate(): void
    {
        $renderer = new StandardRenderer(new TestingStringifier());

        $result = (new ResultBuilder())->template('This is my template')->build();

        self::assertSame($result->template, $renderer->render($result, new DummyTranslator()));
    }

    #[Test]
    public function itShouldRenderResultOverwritingCustomTemplateWhenTemplateIsPassedAsAnArgument(): void
    {
        $renderer = new StandardRenderer(new TestingStringifier());

        $template = 'This is my brand new template';

        $result = (new ResultBuilder())->template('This is my template')->build();

        self::assertSame($template, $renderer->render($result, new DummyTranslator(), $template));
    }

    #[Test]
    public function itShouldRenderResultProcessingParametersInTheTemplate(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new StandardRenderer($stringifier);

        $key = 'foo';
        $value = true;

        $result = (new ResultBuilder())
            ->template(sprintf('Will replace {{%s}}', $key))
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            'Will replace ' . $stringifier->stringify($value, 0),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingRawParametersInTheTemplate(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new StandardRenderer($stringifier);

        $key = 'foo';
        $value = 0.1;

        $result = (new ResultBuilder())
            ->template(sprintf('Will replace {{%1$s}} and {{%1$s|raw}}', $key))
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            sprintf('Will replace %s and 0.1', $stringifier->stringify($value, 0)),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingRawBooleanParametersInTheTemplate(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new StandardRenderer($stringifier);

        $key = 'foo';
        $value = false;

        $result = (new ResultBuilder())
            ->template(sprintf('Will replace {{%1$s}} and {{%1$s|raw}}', $key))
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            sprintf('Will replace %s and 0', $stringifier->stringify($value, 0)),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingTranslatableParametersInTheTemplate(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new StandardRenderer($stringifier);

        $key = 'foo';
        $value = 'original';
        $translation = 'translated';

        $result = (new ResultBuilder())
            ->template(sprintf('Will replace {{%1$s}} and {{%1$s|trans}}', $key))
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            sprintf('Will replace %s and %s', $stringifier->stringify($value, 0), $translation),
            $renderer->render($result, new ArrayTranslator([$value => $translation]))
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNameParameterWhenItIsInTheTemplateAndItIsString(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new StandardRenderer($stringifier);

        $value = 'original';

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->parameters(['name' => $value])
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $value),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNameParameterWhenItIsInTheTemplateAndItIsNotString(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new StandardRenderer($stringifier);

        $value = true;

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->parameters(['name' => $value])
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $stringifier->stringify($value, 0)),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNameAsSomeParameterInTheTemplate(): void
    {
        $renderer = new StandardRenderer(new TestingStringifier());

        $name = 'my name';

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->name($name)
            ->build();

        self::assertSame(
            'Will replace ' . $name,
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingInputAsNameWhenResultHasNoName(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new StandardRenderer($stringifier);

        $input = 42;

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->input($input)
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $stringifier->stringify($input, 0)),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingInputAsSomeParameterInTheTemplate(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new StandardRenderer($stringifier);

        $input = 42;

        $result = (new ResultBuilder())
            ->template('Will replace {{input}}')
            ->input($input)
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $stringifier->stringify($input, 0)),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultNotOverwritingNameParameterWithRealName(): void
    {
        $parameterNameValue = 'fake name';

        $stringifier = new TestingStringifier();

        $renderer = new StandardRenderer($stringifier);

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->name('real name')
            ->parameters(['name' => $parameterNameValue])
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $parameterNameValue),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultNotOverwritingInputParameterWithRealInput(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new StandardRenderer($stringifier);

        $input = 'real input';

        $result = (new ResultBuilder())
            ->template('Will replace {{input}}')
            ->input($input)
            ->parameters(['input' => 'fake input'])
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $stringifier->stringify($input, 0)),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNonExistingParameters(): void
    {
        $renderer = new StandardRenderer(new TestingStringifier());

        $result = (new ResultBuilder())
            ->template('Will not replace {{unknown}}')
            ->build();

        self::assertSame('Will not replace {{unknown}}', $renderer->render($result, new DummyTranslator()));
    }

    #[Test]
    public function itShouldRenderResultTranslatingTemplate(): void
    {
        $template = 'This is my template with {{foo}}';
        $translations = [$template => 'This is my translated template with {{foo}}'];

        $renderer = new StandardRenderer(new TestingStringifier());
        $translator = new ArrayTranslator($translations);

        $result = (new ResultBuilder())
            ->template($template)
            ->build();

        self::assertSame($translations[$template], $renderer->render($result, $translator));
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplate(): void
    {
        $stringifier = new TestingStringifier();
        $renderer = new StandardRenderer($stringifier);

        $result = (new ResultBuilder())->build();

        self::assertSame(
            sprintf('%s must be a valid stub', $stringifier->stringify($result->input, 0)),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplateAndInvertedMode(): void
    {
        $stringifier = new TestingStringifier();
        $renderer = new StandardRenderer($stringifier);

        $result = (new ResultBuilder())->mode(Mode::INVERTED)->build();

        self::assertSame(
            sprintf('%s must not be a valid stub', $stringifier->stringify($result->input, 0)),
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplateWhenCannotFindAttachedTemplate(): void
    {
        $renderer = new StandardRenderer(new TestingStringifier());

        $result = (new ResultBuilder())->template('__not_standard__')->mode(Mode::INVERTED)->build();

        self::assertSame(
            $result->template,
            $renderer->render($result, new DummyTranslator())
        );
    }

    #[Test]
    public function itShouldRenderResultWithItsAdjacentsWhenItHasNoCustomTemplate(): void
    {
        $renderer = new StandardRenderer(new TestingStringifier());

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

        self::assertSame($expect, $renderer->render($result, new DummyTranslator()));
    }

    #[Test]
    public function itShouldRenderResultWithoutItsAdjacentsWhenItHasCustomTemplate(): void
    {
        $template = 'Custom template';

        $result = (new ResultBuilder())->template($template)
            ->adjacent((new ResultBuilder())->template('and this is a adjacent')->build())
            ->build();

        $renderer = new StandardRenderer(new TestingStringifier());

        self::assertSame($template, $renderer->render($result, new DummyTranslator()));
    }
}
