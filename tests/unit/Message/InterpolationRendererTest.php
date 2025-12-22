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
use Respect\Validation\Name;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingStringifier;
use Respect\Validation\Test\TestCase;

use function sprintf;

#[CoversClass(InterpolationRenderer::class)]
final class InterpolationRendererTest extends TestCase
{
    #[Test]
    public function itShouldRenderResultWithCustomTemplate(): void
    {
        $renderer = new InterpolationRenderer(new DummyTranslator(), new TestingStringifier());

        $result = (new ResultBuilder())->template('This is my template')->build();

        self::assertSame($result->template, $renderer->render($result, []));
    }

    #[Test]
    public function itShouldRenderResultProcessingParametersInTheTemplate(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $key = 'foo';
        $value = true;

        $result = (new ResultBuilder())
            ->template(sprintf('Will replace {{%s}}', $key))
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            'Will replace ' . $stringifier->stringify($value, 0),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingRawParametersInTheTemplate(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $key = 'foo';
        $value = 0.1;

        $result = (new ResultBuilder())
            ->template(sprintf('Will replace {{%1$s}} and {{%1$s|raw}}', $key))
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            sprintf('Will replace %s and 0.1', $stringifier->stringify($value, 0)),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingRawBooleanParametersInTheTemplate(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $key = 'foo';
        $value = false;

        $result = (new ResultBuilder())
            ->template(sprintf('Will replace {{%1$s}} and {{%1$s|raw}}', $key))
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            sprintf('Will replace %s and 0', $stringifier->stringify($value, 0)),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingTranslatableParametersInTheTemplate(): void
    {
        $key = 'foo';
        $value = 'original';
        $translation = 'translated';

        $stringifier = new TestingStringifier();
        $renderer = new InterpolationRenderer(new ArrayTranslator([$value => $translation]), $stringifier);

        $result = (new ResultBuilder())
            ->template(sprintf('Will replace {{%1$s}} and {{%1$s|trans}}', $key))
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            sprintf('Will replace %s and %s', $stringifier->stringify($value, 0), $translation),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNameParameterWhenItIsInTheTemplateAndItIsString(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $value = 'original';

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->parameters(['name' => $value])
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $stringifier->stringify(new Name($value), 0) ?? 'FAILED'),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNameParameterWhenItIsInTheTemplateAndItIsNotString(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $value = true;

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->parameters(['name' => $value])
            ->build();

        self::assertSame(
            sprintf(
                'Will replace %s',
                $stringifier->stringify(new Name((string) $stringifier->stringify($value, 0)), 0),
            ),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNameAsSomeParameterInTheTemplate(): void
    {
        $stringifier = new TestingStringifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $name = 'my name';

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->name($name)
            ->build();

        self::assertSame(
            'Will replace ' . $stringifier->stringify(new Name($name), 0),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingInputAsNameWhenResultHasNoName(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $input = 42;

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->input($input)
            ->build();

        self::assertSame(
            sprintf(
                'Will replace %s',
                $stringifier->stringify(new Name((string) $stringifier->stringify($input, 0)), 0),
            ),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingInputAsSomeParameterInTheTemplate(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $input = 42;

        $result = (new ResultBuilder())
            ->template('Will replace {{input}}')
            ->input($input)
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $stringifier->stringify($input, 0)),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultNotOverwritingNameParameterWithRealName(): void
    {
        $parameterNameValue = 'fake name';

        $stringifier = new TestingStringifier();

        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $result = (new ResultBuilder())
            ->template('Will replace {{name}}')
            ->name('real name')
            ->parameters(['name' => $parameterNameValue])
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $stringifier->stringify(new Name($parameterNameValue), 0)),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultNotOverwritingInputParameterWithRealInput(): void
    {
        $stringifier = new TestingStringifier();

        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $input = 'real input';

        $result = (new ResultBuilder())
            ->template('Will replace {{input}}')
            ->input($input)
            ->parameters(['input' => 'fake input'])
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $stringifier->stringify($input, 0)),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNonExistingParameters(): void
    {
        $renderer = new InterpolationRenderer(new DummyTranslator(), new TestingStringifier());

        $result = (new ResultBuilder())
            ->template('Will not replace {{unknown}}')
            ->build();

        self::assertSame('Will not replace {{unknown}}', $renderer->render($result, []));
    }

    #[Test]
    public function itShouldRenderResultTranslatingTemplate(): void
    {
        $template = 'This is my template with {{foo}}';
        $translations = [$template => 'This is my translated template with {{foo}}'];

        $translator = new ArrayTranslator($translations);
        $renderer = new InterpolationRenderer($translator, new TestingStringifier());

        $result = (new ResultBuilder())
            ->template($template)
            ->build();

        self::assertSame($translations[$template], $renderer->render($result, []));
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplate(): void
    {
        $stringifier = new TestingStringifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $result = (new ResultBuilder())->build();

        self::assertSame(
            sprintf(
                '%s must be a valid stub',
                $stringifier->stringify(new Name((string) $stringifier->stringify($result->input, 0)), 0),
            ),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplateAndInvertedMode(): void
    {
        $stringifier = new TestingStringifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $stringifier);

        $result = (new ResultBuilder())->hasInvertedMode()->build();

        self::assertSame(
            sprintf(
                '%s must not be a valid stub',
                $stringifier->stringify(new Name((string) $stringifier->stringify($result->input, 0)), 0),
            ),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplateWhenCannotFindAttachedTemplate(): void
    {
        $renderer = new InterpolationRenderer(new DummyTranslator(), new TestingStringifier());

        $result = (new ResultBuilder())->template('__not_standard__')->hasInvertedMode()->build();

        self::assertSame(
            $result->template,
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultWithItsAdjacentsWhenItHasNoCustomTemplate(): void
    {
        $renderer = new InterpolationRenderer(new DummyTranslator(), new TestingStringifier());

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
    public function itShouldRenderResultWithoutItsAdjacentsWhenItHasCustomTemplate(): void
    {
        $template = 'Custom template';

        $result = (new ResultBuilder())->template($template)
            ->adjacent((new ResultBuilder())->template('and this is a adjacent')->build())
            ->build();

        $renderer = new InterpolationRenderer(new DummyTranslator(), new TestingStringifier());

        self::assertSame($template, $renderer->render($result, []));
    }
}
