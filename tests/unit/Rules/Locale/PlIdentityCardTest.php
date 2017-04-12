<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\RuleTestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Locale\PlIdentityCard
 */
class PlIdentityCardTest extends RuleTestCase
{
    public function providerForValidInput()
    {
        $rule = new PlIdentityCard();

        return [
            [$rule, 'APH505567'],
            [$rule, 'AYE205410'],
            [$rule, 'AYW036733'],
        ];
    }

    public function providerForInvalidInput()
    {
        $rule = new PlIdentityCard();

        return [
            [$rule, 'AAAAAAAAA'],
            [$rule, 'APH 505567'],
            [$rule, 'AYE205411'],
            [$rule, 'AYW036731'],
        ];
    }
}
