<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use finfo;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;

#[Group('validator')]
#[CoversClass(Image::class)]
final class ImageTest extends RuleTestCase
{
    #[Test]
    public function shouldValidateWithDefinedInstanceOfFileInfo(): void
    {
        $input = self::fixture('valid-image.gif');

        $finfo = $this->createMock(finfo::class);
        $finfo
            ->expects(self::once())
            ->method('file')
            ->with($input)
            ->willReturn('image/gif');

        $validator = new Image($finfo);

        self::assertValidInput($validator, $input);
    }

    /** @return iterable<array{Image, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Image();

        return [
            [$validator, self::fixture('valid-image.gif')],
            [$validator, self::fixture('valid-image.jpg')],
            [$validator, self::fixture('valid-image.png')],
            [$validator, new SplFileInfo(self::fixture('valid-image.gif'))],
            [$validator, new SplFileInfo(self::fixture('valid-image.jpg'))],
            [$validator, new SplFileObject(self::fixture('valid-image.png'))],
        ];
    }

    /** @return iterable<array{Image, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Image();

        return [
            [$validator, self::fixture('invalid-image.png')],
            [$validator, 'asdf'],
            [$validator, 1],
            [$validator, true],
        ];
    }
}
