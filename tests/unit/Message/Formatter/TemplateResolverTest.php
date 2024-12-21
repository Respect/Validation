<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\Placeholder\Path;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\TestCase;
use stdClass;

#[CoversClass(TemplateResolver::class)]
final class TemplateResolverTest extends TestCase
{
    #[Test]
    public function itShouldReturnResultWithTemplateWhenKeyExists(): void
    {
        $result = (new ResultBuilder())->withPath(new Path('foo-path'))->build();
        $templates = ['foo-path' => 'My custom template'];
        $sut = new TemplateResolver();
        $newResult = $sut->resolve($result, $templates);

        self::assertNotSame($result, $newResult);
        self::assertSame('My custom template', $newResult->template);
    }

    #[Test]
    public function itShouldThrowExceptionWhenTemplateIsNotString(): void
    {
        $this->expectException(ComponentException::class);

        $result = (new ResultBuilder())->withPath(new Path('foo-path'))->build();
        $templates = ['foo-path' => new stdClass()];
        $sut = new TemplateResolver();
        $sut->resolve($result, $templates);
    }

    #[Test]
    public function itShouldReturnTrueForIsFinalTemplateWhenTemplateIsString(): void
    {
        $result = (new ResultBuilder())->withPath(new Path('foo-path'))->build();
        $templates = ['foo-path' => 'My custom template'];
        $sut = new TemplateResolver();

        self::assertTrue($sut->hasMatch($result, $templates));
    }

    #[Test]
    public function itShouldReturnFalseForIsFinalTemplateWhenTemplateIsNotString(): void
    {
        $result = (new ResultBuilder())->withPath(new Path('foo-path'))->build();
        $templates = ['foo-path' => ['my-template']];
        $sut = new TemplateResolver();

        self::assertFalse($sut->hasMatch($result, $templates));
    }

    #[Test]
    public function itShouldSelectSubTemplatesWhenKeyExistsAndIsArray(): void
    {
        $result = (new ResultBuilder())->withPath(new Path('foo-path'))->build();
        $subTemplates = ['sub' => 'template'];
        $templates = ['foo-path' => $subTemplates];
        $sut = new TemplateResolver();
        $selected = $sut->selectMatches($result, $templates);

        self::assertSame($subTemplates, $selected);
    }

    #[Test]
    public function itShouldReturnOriginalTemplatesWhenKeyDoesNotExist(): void
    {
        $result = (new ResultBuilder())->withPath(new Path('foo-path'))->build();
        $templates = ['bar-path' => ['sub' => 'template']];
        $sut = new TemplateResolver();
        $selected = $sut->selectMatches($result, $templates);

        self::assertSame($templates, $selected);
    }
}
