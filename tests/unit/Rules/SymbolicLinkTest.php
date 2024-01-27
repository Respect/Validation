<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;

use function tmpfile;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\SymbolicLink
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Gus Antoniassi <gus.antoniassi@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SymbolicLinkTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $sut = new SymbolicLink();

        return [
            'filename' => [$sut, 'tests/fixtures/symbolic-link'],
            'SplFileInfo' => [$sut, new SplFileInfo('tests/fixtures/symbolic-link')],
            'SplFileObject' => [$sut, new SplFileObject('tests/fixtures/symbolic-link')],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $sut = new SymbolicLink();

        return [
            'no existing filename' => [$sut, 'tests/fixtures/non-existing-symbolic-link'],
            'no existing SplFileInfo' => [$sut, new SplFileInfo('tests/fixtures/non-existing-symbolic-link')],
            'bool true' => [$sut, true],
            'bool false' => [$sut, false],
            'empty string' => [$sut, ''],
            'array' => [$sut, []],
            'resource' => [$sut, tmpfile()],
        ];
    }
}
