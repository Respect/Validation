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

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Executable
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Royall Spence <royall@royall.us>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class ExecutableTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Executable();

        return [
            [$rule, 'tests/fixtures/executable'],
            [$rule, new SplFileInfo('tests/fixtures/executable')],
            [$rule, new SplFileObject('tests/fixtures/executable')],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Executable();

        return [
            [$rule, 'tests/fixtures/valid-image.gif'],
            [$rule, new SplFileInfo('tests/fixtures/valid-image.jpg')],
            [$rule, new SplFileObject('tests/fixtures/valid-image.png')],
        ];
    }
}
