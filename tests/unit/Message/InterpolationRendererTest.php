<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\Formatter\TemplateResolver;
use Respect\Validation\Message\Placeholder\Subject;
use Respect\Validation\Message\Translator\ArrayTranslator;
use Respect\Validation\Message\Translator\DummyTranslator;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingModifier;
use Respect\Validation\Test\TestCase;

use function sprintf;

#[CoversClass(InterpolationRenderer::class)]
final class InterpolationRendererTest extends TestCase
{
    #[Test]
    public function itShouldRenderResultWithCustomTemplate(): void
    {
        $renderer = new InterpolationRenderer(new DummyTranslator(), new TestingModifier(), new TemplateResolver());

        $result = (new ResultBuilder())->template('This is my template')->build();

        self::assertSame($result->template, $renderer->render($result, []));
    }

    #[Test]
    public function itShouldRenderResultProcessingParametersInTheTemplate(): void
    {
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $modifier, new TemplateResolver());

        $key = 'foo';
        $value = true;

        $result = (new ResultBuilder())
            ->template(sprintf('Will replace {{%s}}', $key))
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            'Will replace ' . $modifier->modify($value, null),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingModifierParametersInTheTemplate(): void
    {
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $modifier, new TemplateResolver());

        $key = 'foo';
        $value = 0.1;

        $result = (new ResultBuilder())
            ->template(sprintf('Will replace {{%1$s}} and {{%1$s|modifier}}', $key))
            ->parameters([$key => $value])
            ->build();

        self::assertSame(
            sprintf('Will replace %s and %s', $modifier->modify($value, null), $modifier->modify($value, 'modifier')),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNameAsSomeParameterInTheTemplate(): void
    {
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $modifier, new TemplateResolver());

        $name = 'my name';

        $result = (new ResultBuilder())
            ->template('Will replace {{subject}}')
            ->name($name)
            ->build();

        $subject = Subject::fromResult($result);

        self::assertSame(
            'Will replace ' . $modifier->modify($subject, null),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingInputAsNameWhenResultHasNoName(): void
    {
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $modifier, new TemplateResolver());

        $input = 42;

        $result = (new ResultBuilder())
            ->template('Will replace {{subject}}')
            ->input($input)
            ->build();

        $subject = Subject::fromResult($result);

        self::assertSame(
            sprintf(
                'Will replace %s',
                $modifier->modify($subject, null),
            ),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingInputAsSomeParameterInTheTemplate(): void
    {
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $modifier, new TemplateResolver());

        $input = 42;

        $result = (new ResultBuilder())
            ->template('Will replace {{input}}')
            ->input($input)
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $modifier->modify($input, null)),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultNotOverwritingNameParameterWithRealName(): void
    {
        $parameterNameValue = 'fake name';

        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $modifier, new TemplateResolver());

        $result = (new ResultBuilder())
            ->template('Will replace {{subject}}')
            ->name('real name')
            ->parameters(['name' => $parameterNameValue])
            ->build();

        $subject = Subject::fromResult($result);

        self::assertSame(
            sprintf('Will replace %s', $modifier->modify($subject, null)),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultNotOverwritingInputParameterWithRealInput(): void
    {
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $modifier, new TemplateResolver());

        $input = 'real input';

        $result = (new ResultBuilder())
            ->template('Will replace {{input}}')
            ->input($input)
            ->parameters(['input' => 'fake input'])
            ->build();

        self::assertSame(
            sprintf('Will replace %s', $modifier->modify($input, null)),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultProcessingNonExistingParameters(): void
    {
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer(new DummyTranslator(), $modifier, new TemplateResolver());

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
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer($translator, $modifier, new TemplateResolver());

        $result = (new ResultBuilder())
            ->template($template)
            ->build();

        self::assertSame($translations[$template], $renderer->render($result, []));
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplate(): void
    {
        $translator = new DummyTranslator();
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer($translator, $modifier, new TemplateResolver());

        $result = (new ResultBuilder())->build();

        $subject = Subject::fromResult($result);

        self::assertSame(
            sprintf(
                '%s must be a valid stub',
                $modifier->modify($subject, null),
            ),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplateAndInvertedMode(): void
    {
        $translator = new DummyTranslator();
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer($translator, $modifier, new TemplateResolver());

        $result = (new ResultBuilder())->hasInvertedMode()->build();

        $subject = Subject::fromResult($result);

        self::assertSame(
            sprintf(
                '%s must not be a valid stub',
                $modifier->modify($subject, null),
            ),
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultWithNonCustomTemplateWhenCannotFindAttachedTemplate(): void
    {
        $translator = new DummyTranslator();
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer($translator, $modifier, new TemplateResolver());

        $result = (new ResultBuilder())->template('__not_standard__')->hasInvertedMode()->build();

        self::assertSame(
            $result->template,
            $renderer->render($result, []),
        );
    }

    #[Test]
    public function itShouldRenderResultWithItsAdjacentsWhenItHasNoCustomTemplate(): void
    {
        $translator = new DummyTranslator();
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer($translator, $modifier, new TemplateResolver());

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

        $translator = new DummyTranslator();
        $modifier = new TestingModifier();
        $renderer = new InterpolationRenderer($translator, $modifier, new TemplateResolver());

        self::assertSame($template, $renderer->render($result, []));
    }
}
