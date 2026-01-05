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

#[Group('validator')]
#[CoversClass(PublicDomainSuffix::class)]
final class PublicDomainSuffixTest extends RuleTestCase
{
    /** @return iterable<array{PublicDomainSuffix, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new PublicDomainSuffix();

        return [
            [$validator, ''],
            [$validator, 'co.uk'],
            [$validator, 'nom.br'],
            [$validator, 'WWW.CK'],
        ];
    }

    /** @return iterable<array{PublicDomainSuffix, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new PublicDomainSuffix();

        return [
            [$validator, []],
            [$validator, null],
            [$validator, new stdClass()],
            [$validator, 'NONONONONONONONONON'],
            [$validator, 'NONONONONONONONONON.uk'],
            [$validator, 'invalid.com'],
            [$validator, 'tk'],
        ];
    }
}
