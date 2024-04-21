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

#[Group('rule')]
#[CoversClass(PublicDomainSuffix::class)]
final class PublicDomainSuffixTest extends RuleTestCase
{
    /** @return iterable<array{PublicDomainSuffix, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new PublicDomainSuffix();

        return [
            [$rule, ''],
            [$rule, 'co.uk'],
            [$rule, 'nom.br'],
            [$rule, 'WWW.CK'],
        ];
    }

    /** @return iterable<array{PublicDomainSuffix, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new PublicDomainSuffix();

        return [
            [$rule, []],
            [$rule, null],
            [$rule, new stdClass()],
            [$rule, 'NONONONONONONONONON'],
            [$rule, 'NONONONONONONONONON.uk'],
            [$rule, 'invalid.com'],
            [$rule, 'tk'],
        ];
    }
}
