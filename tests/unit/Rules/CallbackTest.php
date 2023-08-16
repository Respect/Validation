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
 * @covers \Respect\Validation\Rules\Callback
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CallbackTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Callback('is_a', 'stdClass'), new stdClass()],
            [new Callback([$this, 'sampleCallbackUsedInsideThisTest']), 'test'],
            [new Callback('is_string'), 'test'],
            [
                new Callback(static function () {
                    return true;
                }),
                'wpoiur',
            ],
        ];
    }

    public function sampleCallbackUsedInsideThisTest(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [
                new Callback(static function () {
                    return false;
                }),
                'w poiur',
            ],
            [
                new Callback(static function () {
                    return false;
                }),
                '',
            ],
        ];
    }
}
