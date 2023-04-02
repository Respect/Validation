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
 * @covers \Respect\Validation\Rules\Imei
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Diego Oliveira <contato@diegoholiveira.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ImeiTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Imei();

        return [
            [$rule, '35-007752-323751-3'],
            [$rule, '35-209900-176148-1'],
            [$rule, '350077523237513'],
            [$rule, '356938035643809'],
            [$rule, '490154203237518'],
            [$rule, 350077523237513],
            [$rule, 356938035643809],
            [$rule, 490154203237518],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Imei();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 1.0],
            [$rule, new stdClass()],
            [$rule, '490154203237512'],
            [$rule, '4901542032375125'],
            [$rule, 'Whateveeeeeerrr'],
            [$rule, true],
        ];
    }
}
