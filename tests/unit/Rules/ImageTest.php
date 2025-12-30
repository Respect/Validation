<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use finfo;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;

#[Group('rule')]
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

        $rule = new Image($finfo);

        self::assertValidInput($rule, $input);
    }

    /** @return iterable<array{Image, mixed}> */
    public static function providerForValidInput(): iterable
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

    /** @return iterable<array{Image, mixed}> */
    public static function providerForInvalidInput(): iterable
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
