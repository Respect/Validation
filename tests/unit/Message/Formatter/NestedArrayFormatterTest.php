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
use Respect\Validation\Message\Translator\DummyTranslator;
use Respect\Validation\Result;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingMessageRenderer;
use Respect\Validation\Test\TestCase;
use stdClass;

use function Respect\Stringifier\stringify;
use function sprintf;

#[CoversClass(NestedArrayFormatter::class)]
final class NestedArrayFormatterTest extends TestCase
{
    use ResultCreator;

    /**
     * @param array<string, mixed> $expected
     * @param array<string, mixed> $templates
     */
    #[Test]
    #[DataProvider('provideForArray')]
    public function itShouldFormatArrayMessage(Result $result, array $expected, array $templates = []): void
    {
        $formatter = new NestedArrayFormatter(
            renderer: new TestingMessageRenderer(),
            templateResolver: new TemplateResolver(),
        );

        self::assertSame($expected, $formatter->format($result, $templates, new DummyTranslator()));
    }

    #[Test]
    public function itShouldThrowAnExceptionWhenTryingToFormatAndTemplateIsInvalid(): void
    {
        $formatter = new NestedArrayFormatter(
            renderer: new TestingMessageRenderer(),
            templateResolver: new TemplateResolver(),
        );
        $result = (new ResultBuilder())->id('foo')->build();

        $template = new stdClass();

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage(sprintf('Template for "foo" must be a string, %s given', stringify($template)));

        $formatter->format($result, ['foo' => $template], new DummyTranslator());
    }

    /** @return array<string, array{0: Result, 1: array<string, mixed>, 2?: array<string, mixed>}> */
    public static function provideForArray(): array
    {
        return [
            'without children, without templates' => [
                (new ResultBuilder())->id('only')->template('__parent_original__')->build(),
                ['only' => '__parent_original__'],
            ],
            'without children, with templates' => [
                (new ResultBuilder())->id('only')->build(),
                ['only' => 'Custom template'],
                ['only' => 'Custom template'],
            ],
            'with single-level children, without templates' => [
                self::singleLevelChildrenMessage(),
                [
                    '__root__' => '__parent_original__',
                    '1st' => '__1st_original__',
                    '2nd' => '__2nd_original__',
                    '3rd' => '__3rd_original__',
                ],
            ],
            'with single-level children, with templates' => [
                self::singleLevelChildrenMessage(),
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => '2nd custom',
                    '3rd' => '3rd custom',
                ],
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => '2nd custom',
                    '3rd' => '3rd custom',
                ],
            ],
            'with single-level children, with partial templates' => [
                self::singleLevelChildrenMessage(),
                [
                    '__root__' => '__parent_original__',
                    '1st' => '1st custom',
                    '2nd' => '__2nd_original__',
                    '3rd' => '3rd custom',
                ],
                [
                    '1st' => '1st custom',
                    '3rd' => '3rd custom',
                ],
            ],
            'with single-level children, with overwritten template' => [
                self::singleLevelChildrenMessage(),
                ['parent' => 'Parent custom'],
                ['parent' => 'Parent custom'],
            ],
            'with single-nested child, without templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                [
                    '__root__' => '__parent_original__',
                    '1st' => '__1st_original__',
                    '2nd' => '__2nd_1st_original__',
                    '3rd' => '__3rd_original__',
                ],
            ],
            'with single-nested child, with templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => '2nd > 1st custom',
                    '3rd' => '3rd custom',
                ],
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => ['2nd_1st' => '2nd > 1st custom'],
                    '3rd' => '3rd custom',
                ],
            ],
            'with single-nested child, with partial templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => '__2nd_1st_original__',
                    '3rd' => '3rd custom',
                ],
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => ['2nd_2nd' => '2nd > 2nd not shown'],
                    '3rd' => '3rd custom',
                ],
            ],
            'with single-nested child, with overwritten templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => '2nd custom',
                    '3rd' => '3rd custom',
                ],
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => '2nd custom',
                    '3rd' => '3rd custom',
                ],
            ],
            'with multi-nested children, without templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                [
                    '__root__' => '__parent_original__',
                    '1st' => '__1st_original__',
                    '2nd' => [
                        '__root__' => '__2nd_original__',
                        '2nd_1st' => '__2nd_1st_original__',
                        '2nd_2nd' => '__2nd_2nd_original__',
                    ],
                    '3rd' => '__3rd_original__',
                ],
            ],
            'with multi-nested children, with templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => [
                        '__root__' => '2nd custom',
                        '2nd_1st' => '2nd > 1st custom',
                        '2nd_2nd' => '2nd > 2nd custom',
                    ],
                    '3rd' => '3rd custom',
                ],
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => [
                        '__root__' => '2nd custom',
                        '2nd_1st' => '2nd > 1st custom',
                        '2nd_2nd' => '2nd > 2nd custom',
                    ],
                    '3rd' => '3rd custom',
                ],
            ],
            'with multi-nested children, with partial templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => [
                        '__root__' => '__2nd_original__',
                        '2nd_1st' => '__2nd_1st_original__',
                        '2nd_2nd' => '2nd > 2nd custom',
                    ],
                    '3rd' => '3rd custom',
                ],
                [
                    '__root__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => ['2nd_2nd' => '2nd > 2nd custom'],
                    '3rd' => '3rd custom',
                ],
            ],
        ];
    }
}
