<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;

#[Group('validator')]
#[CoversClass(Extension::class)]
final class ExtensionTest extends RuleTestCase
{
    /** @return iterable<array{Extension, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            'txt' => [new Extension('txt'), 'filename.txt'],
            'jpg' => [new Extension('jpg'), 'filename.jpg'],
            'inc' => [new Extension('inc'), 'filename.inc'],
            'bz2' => [new Extension('bz2'), 'filename.foo.bar.bz2'],
            'php' => [new Extension('php'), new SplFileInfo(__FILE__)],
            'png' => [new Extension('png'), self::fixture('valid-image.png')],
            'gif' => [new Extension('gif'), self::fixture('valid-image.gif')],
            'file-invalid' => [new Extension('png'), self::fixture('invalid-image.png')],
        ];
    }

    /** @return iterable<array{Extension, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            'jpg' => [new Extension('jpg'), 'filename.txt'],
            'txt' => [new Extension('txt'), 'filename.jpg'],
            'bz2' => [new Extension('bz2'), 'filename.inc.php'],
            'js' => [new Extension('js'), 'filename.foo.bar.bz2'],
            'php' => [new Extension('php'), [__FILE__]],
            'mp3' => [new Extension('mp3'), 999],
            'gif' => [new Extension('gif'), ''],
            'doc' => [new Extension('doc'), null],
        ];
    }
}
