<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function stream_context_create;

final class PortugueseNifTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new PortugueseNif();

        return [
            [$rule, '124885446'],
            [$rule, '296981079'],
            [$rule, '372697216'],
            [$rule, '452536910'],
            [$rule, '547512104'],
            [$rule, '600481093'],
            [$rule, '709060548'],
            [$rule, '748501746'],
            [$rule, '755231872'],
            [$rule, '712993010'],
            [$rule, '726086193'],
            [$rule, '774001437'],
            [$rule, '787667560'],
            [$rule, '796553823'],
            [$rule, '839697350'],
            [$rule, '909339260'],
            [$rule, '912534087'],
            [$rule, '982150148'],
            [$rule, '990402509'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new PortugueseNif();

        return [
            // Check digit is wrong
            [$rule, '129468882'],
            [$rule, '220005245'],
            [$rule, '389684008'],
            [$rule, '454438148'],
            [$rule, '504116863'],
            [$rule, '671236496'],
            [$rule, '703830557'],
            [$rule, '743373410'],
            [$rule, '750701191'],
            [$rule, '710147053'],
            [$rule, '725277167'],
            [$rule, '777722796'],
            [$rule, '784431824'],
            [$rule, '798137629'],
            [$rule, '801391192'],
            [$rule, '907147885'],
            [$rule, '911864617'],
            [$rule, '983401988'],
            [$rule, '995934101'],

            // Invalid formats
            [$rule, 'ABC885446'],
            [$rule, '29698107'],
            [$rule, '3726972165'],

            // Weird types
            [$rule, []],
            [$rule, true],
            [$rule, 1],
            [$rule, 0.5],
            [$rule, null],
            [$rule, new stdClass()],
            [$rule, stream_context_create()],

        ];
    }
}
