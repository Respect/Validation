<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Validators\Stub;

use function rand;

#[Group('validator')]
#[CoversClass(Given::class)]
final class GivenTest extends RuleTestCase
{
    /** @return array<array{Given, mixed}> */
    public static function providerForValidInput(): array
    {
        return [
            'when fail, then daze' => [new Given(Stub::fail(1), Stub::daze()), rand()],
            'when pass, then pass' => [new Given(Stub::pass(1), Stub::pass(1)), rand()],
        ];
    }

    /** @return array<array{Given, mixed}> */
    public static function providerForInvalidInput(): array
    {
        return [
            'when pass, then fail' => [new Given(Stub::pass(1), Stub::fail(1)), rand()],
        ];
    }
}
