<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayObject;
use Respect\Validation\Test\RuleTestCase;
use SimpleXMLElement;
use stdClass;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\ArrayVal
 */
final class ArrayValTest extends RuleTestCase
{
    /**
     * @return array<array{ArrayVal, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new ArrayVal();

        return [
            [$rule, []],
            [$rule, [1, 2, 3]],
            [$rule, new ArrayObject()],
            [$rule, new SimpleXMLElement('<foo></foo>')],
        ];
    }

    /**
     * @return array<array{ArrayVal, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new ArrayVal();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 121],
            [$rule, new stdClass()],
            [$rule, false],
            [$rule, 'aaa'],
        ];
    }
}
