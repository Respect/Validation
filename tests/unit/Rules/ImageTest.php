<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use finfo;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Image
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Guilherme Siani <guilherme@siani.com.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ImageTest extends RuleTestCase
{
    /**
     * @test
     */
    public function shouldValidateWithDefinedInstanceOfFileInfo(): void
    {
        $input = self::fixture('valid-image.gif');

        $finfo = $this->createMock(finfo::class);
        $finfo
            ->expects(self::once())
            ->method('file')
            ->with($input)
            ->will(self::returnValue('image/gif'));

        $rule = new Image($finfo);

        self::assertTrue($rule->validate($input));
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Image();

        return [
            [$rule, self::fixture('valid-image.gif')],
            [$rule, self::fixture('valid-image.jpg')],
            [$rule, self::fixture('valid-image.png')],
            [$rule, new SplFileInfo(self::fixture('valid-image.gif'))],
            [$rule, new SplFileInfo(self::fixture('valid-image.jpg'))],
            [$rule, new SplFileObject(self::fixture('valid-image.png'))],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Image();

        return [
            [$rule, self::fixture('invalid-image.png')],
            [$rule, 'asdf'],
            [$rule, 1],
            [$rule, true],
        ];
    }
}
