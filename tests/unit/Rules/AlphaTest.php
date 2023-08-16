<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Alpha
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class AlphaTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            'alphabetic' => [new Alpha(), 'alganet'],
            'alphabetic with one exception' => [new Alpha('.'), 'google.com'],
            'alphabetic with multiple exceptions' => [new Alpha('0-9'), '0alg-anet9'],
            'non-alphabetic with only exceptions' => [new Alpha('!@#$%^&*(){}'), '!@#$%^&*(){}'],
            'multiple characters to ignore' => [new Alpha('-', ' '), 'a-b c'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            'empty string' => [new Alpha(), ''],
            'symbols' => [new Alpha(), '@#$'],
            'underscore' => [new Alpha(), '_'],
            'non ASCII chars' => [new Alpha(), 'dgç'],
            'alphanumeric' => [new Alpha(), '122al'],
            'digits as string' => [new Alpha(), '122'],
            'integers' => [new Alpha(), 11123],
            'zero' => [new Alpha(), 0],
            'null' => [new Alpha(), null],
            'object' => [new Alpha(), new stdClass()],
            'array' => [new Alpha(), []],
            'newline' => [new Alpha(), "\nabc"],
            'tab' => [new Alpha(), "\tdef"],
            'alphabetic with spaces' => [new Alpha(), 'alganet alganet'],
        ];
    }
}
