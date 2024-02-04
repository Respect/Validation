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
use function tmpfile;

#[Group('rule')]
#[CoversClass(ResourceType::class)]
final class ResourceTypeTest extends RuleTestCase
{
    /** @return iterable<array{ResourceType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new ResourceType();

        return [
            [$rule, stream_context_create()],
            [$rule, tmpfile()],
        ];
    }

    /** @return iterable<array{ResourceType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new ResourceType();

        return [
            [$rule, 'String'],
            [$rule, 123],
            [$rule, []],
            [
                $rule,
                static function (): void {
                },
            ],
            [$rule, new stdClass()],
            [$rule, null],
        ];
    }
}
