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
use Respect\Validation\Test\Stubs\ToStringStub;
use stdClass;

#[Group('rule')]
#[CoversClass(Domain::class)]
final class DomainTest extends RuleTestCase
{
    /** @return iterable<array{Domain, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Domain(false), '111111111111domain.local'],
            [new Domain(false), '111111111111.domain.local'],
            [new Domain(), 'example.com'],
            [new Domain(), 'xn--bcher-kva.ch'],
            [new Domain(), 'mail.xn--bcher-kva.ch'],
            [new Domain(), 'example-hyphen.com'],
            [new Domain(), 'example--valid.com'],
            [new Domain(), 'std--a.com'],
            [new Domain(), 'r--w.com'],
        ];
    }

    /** @return iterable<array{Domain, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Domain(), null],
            [new Domain(), new stdClass()],
            [new Domain(), []],
            [new Domain(), new ToStringStub('google.com')],
            [new Domain(), ''],
            [new Domain(), 'no dots'],
            [new Domain(), '2222222domain.local'],
            [new Domain(), '-example-invalid.com'],
            [new Domain(), 'example.invalid.-com'],
            [new Domain(), 'xn--bcher--kva.ch'],
            [new Domain(), 'example.invalid-.com'],
            [new Domain(), '1.2.3.256'],
            [new Domain(), '1.2.3.4'],
        ];
    }
}
