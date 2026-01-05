<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function stream_context_create;

#[Group('validator')]
#[CoversClass(PortugueseNif::class)]
final class PortugueseNifTest extends RuleTestCase
{
    /** @return iterable<array{PortugueseNif, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new PortugueseNif();

        return [
            [$validator, '124885446'],
            [$validator, '296981079'],
            [$validator, '372697216'],
            [$validator, '452536910'],
            [$validator, '547512104'],
            [$validator, '600481093'],
            [$validator, '709060548'],
            [$validator, '748501746'],
            [$validator, '755231872'],
            [$validator, '712993010'],
            [$validator, '726086193'],
            [$validator, '774001437'],
            [$validator, '787667560'],
            [$validator, '796553823'],
            [$validator, '839697350'],
            [$validator, '909339260'],
            [$validator, '912534087'],
            [$validator, '982150148'],
            [$validator, '990402509'],
        ];
    }

    /** @return iterable<array{PortugueseNif, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new PortugueseNif();

        return [
            // Check digit is wrong
            [$validator, '429468882'],
            [$validator, '739468882'],
            [$validator, '939468882'],
            [$validator, '129468882'],
            [$validator, '220005245'],
            [$validator, '389684008'],
            [$validator, '454438148'],
            [$validator, '504116863'],
            [$validator, '671236496'],
            [$validator, '703830557'],
            [$validator, '743373410'],
            [$validator, '750701191'],
            [$validator, '710147053'],
            [$validator, '725277167'],
            [$validator, '777722796'],
            [$validator, '784431824'],
            [$validator, '798137629'],
            [$validator, '801391192'],
            [$validator, '907147885'],
            [$validator, '911864617'],
            [$validator, '983401988'],
            [$validator, '995934101'],

            // Invalid formats
            [$validator, 'ABC885446'],
            [$validator, '29698107'],
            [$validator, '3726972165'],

            // Weird types
            [$validator, []],
            [$validator, true],
            [$validator, 1],
            [$validator, 0.5],
            [$validator, null],
            [$validator, new stdClass()],
            [$validator, stream_context_create()],

        ];
    }
}
