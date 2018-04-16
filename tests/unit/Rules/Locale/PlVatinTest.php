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

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Locale\PlVatin
 */
class PlVatinTest extends RuleTestCase
{
    public function providerForValidInput(): array
    {
        $rule = new PlVatin();

        return [
            [$rule, '1645865777'],
            [$rule, '5581418257'],
            [$rule, '1298727531'],
        ];
    }

    public function providerForInvalidInput(): array
    {
        $rule = new PlVatin();

        return [
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, '1645865778'],
            [$rule, '164-586-57-77'],
            [$rule, '164-58-65-777'],
            [$rule, '5581418258'],
            [$rule, '1298727532'],
            [$rule, '1234567890'],
        ];
    }
}
