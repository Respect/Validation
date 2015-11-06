<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\ArrayVal
 */
class ImageTest extends RuleTestCase
{
    public function providerForValidInput()
    {
        return [
            ['http://lorempixel.com/400/200/'],
        ];
    }

    public function providerForInvalidInput()
    {
        return [
            [1],
            ['asdf'],
            [true],
        ];
    }
}
