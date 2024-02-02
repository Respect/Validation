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
 * @covers \Respect\Validation\Exceptions\PublicDomainSuffixException
 * @covers \Respect\Validation\Rules\PublicDomainSuffix
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 */
final class PublicDomainSuffixTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new PublicDomainSuffix();

        return [
            [$rule, 'co.uk'],
            [$rule, 'nom.br'],
            [$rule, 'WWW.CK'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
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
