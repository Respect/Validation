<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;

use function random_int;
use function tmpfile;

use const PHP_INT_MAX;

#[Group('validator')]
#[CoversClass(Mimetype::class)]
final class MimetypeTest extends RuleTestCase
{
    /** @return iterable<array{Mimetype, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            'image/png' => [new Mimetype('image/png'), 'tests/fixtures/valid-image.png'],
            'image/gif' => [new Mimetype('image/gif'), 'tests/fixtures/valid-image.gif'],
            'image/jpeg' => [new Mimetype('image/jpeg'), 'tests/fixtures/valid-image.jpg'],
            'text/plain' => [new Mimetype('text/plain'), 'tests/fixtures/executable'],
            'SplFileInfo' => [new Mimetype('image/png'), new SplFileInfo('tests/fixtures/valid-image.png')],
            'SplFileObject' => [new Mimetype('image/png'), new SplFileObject('tests/fixtures/valid-image.png')],
        ];
    }

    /** @return iterable<array{Mimetype, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            'invalid file' => [new Mimetype('image/png'), 'tests/fixtures/invalid-image.png'],
            'mismatch' => [new Mimetype('image/gif'), 'tests/fixtures/valid-image.png'],
            'directory' => [new Mimetype('application/octet-stream'), __DIR__],
            'boolean' => [new Mimetype('application/octet-stream'), true],
            'array' => [new Mimetype('application/octet-stream'), [__FILE__]],
            'integer' => [new Mimetype('application/octet-stream'), random_int(1, PHP_INT_MAX)],
            'float' => [new Mimetype('application/octet-stream'), random_int(1, 9) / 10],
            'null' => [new Mimetype('application/octet-stream'), null],
            'resource' => [new Mimetype('application/octet-stream'), tmpfile()],
        ];
    }
}
