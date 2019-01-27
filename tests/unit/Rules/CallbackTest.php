<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Callback
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CallbackTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Callback('is_a', 'stdClass'), new \stdClass()],
            [new Callback([$this, 'thisIsASampleCallbackUsedInsideThisTest']), 'test'],
            [new Callback('is_string'), 'test'],
            [new Callback(function () { return true; }), 'wpoiur'],
        ];
    }

    public function thisIsASampleCallbackUsedInsideThisTest()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Callback(function () { return false; }), 'w poiur'],
            [new Callback(function () { return false; }), ''],
        ];
    }
}
