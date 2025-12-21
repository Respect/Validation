<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\StandardFormatter\ResultCreator;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingMessageRenderer;
use Respect\Validation\Test\TestCase;
use stdClass;

use function Respect\Stringifier\stringify;
use function sprintf;

#[CoversClass(FirstResultStringFormatter::class)]
final class FirstResultStringFormatterTest extends TestCase
{
    use ResultCreator;

    /** @param array<string, mixed> $templates */
    #[Test]
    #[DataProvider('provideForMain')]
    public function itShouldFormatMainMessage(Result $result, string $expected, array $templates = []): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new FirstResultStringFormatter(new TemplateResolver());

        self::assertSame($expected, $formatter->format($result, $renderer, $templates));
    }

    #[Test]
    public function itShouldThrowAnExceptionWhenTryingToFormatAndTemplateIsInvalid(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new FirstResultStringFormatter(new TemplateResolver());
        $result = (new ResultBuilder())->id('foo')->build();

        $template = new stdClass();

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage(sprintf('Template for "foo" must be a string, %s given', stringify($template)));

        $formatter->format($result, $renderer, ['foo' => $template]);
    }

    /** @return array<string, array{0: Result, 1: string, 2?: array<string, mixed>}> */
    public static function provideForMain(): array
    {
        return [
            'without children, without templates' => [
                (new ResultBuilder())->build(),
                Rule::TEMPLATE_STANDARD,
            ],
            'without children, with templates' => [
                (new ResultBuilder())->build(),
                'This is a new template',
                [(new ResultBuilder())->build()->id->value => 'This is a new template'],
            ],
            'with children, without templates' => [
                (new ResultBuilder())
                    ->id('parent')->id('parent')->template('__parent_original__')
                    ->children(
                        (new ResultBuilder())->id('1st')->template('__1st_original__')->build(),
                        (new ResultBuilder())->id('1st')->template('__2nd_original__')->build(),
                    )
                    ->build(),
                '__1st_original__',
            ],
            'with children, with templates' => [
                (new ResultBuilder())->id('parent')->template('__parent_original__')
                    ->children(
                        (new ResultBuilder())->id('1st')->template('__1st_original__')->build(),
                        (new ResultBuilder())->id('1st')->template('__2nd_original__')->build(),
                    )
                    ->build(),
                '1st custom',
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => '2nd custom',
                ],
            ],
            'with nested children, without templates' => [
                (new ResultBuilder())->id('parent')->template('__parent_original__')
                    ->children(
                        (new ResultBuilder())->id('1st')->template('__1st_original__')
                            ->children(
                                (new ResultBuilder())->id('1st_1st')->template('__1st_1st_original__')->build(),
                                (new ResultBuilder())->id('1st_2nd')->template('__1st_2nd_original__')->build(),
                            )
                            ->build(),
                        (new ResultBuilder())->id('1st')->template('__2nd_original__')->build(),
                    )
                    ->build(),
                '__1st_1st_original__',
            ],
        ];
    }
}
