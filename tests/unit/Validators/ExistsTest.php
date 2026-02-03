<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Kennedy Tedesco <kennedyt.tw@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;

#[Group('validator')]
#[CoversClass(Exists::class)]
final class ExistsTest extends RuleTestCase
{
    /** @return iterable<array{Exists, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Exists();

        return [
            [$validator, __FILE__],
            [$validator, new SplFileInfo(__FILE__)],
            [$validator, new SplFileObject(__FILE__)],
        ];
    }

    /** @return iterable<array{Exists, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Exists();

        return [
            [$validator, 'path/of/a/non-existent/file'],
            [$validator, new SplFileInfo('path/of/a/non-existent/file')],
        ];
    }
}
