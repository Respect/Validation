<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Chris Ramakers <chris.ramakers@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\RuleTestCase;

use const FILTER_FLAG_HOSTNAME;
use const FILTER_FLAG_QUERY_REQUIRED;
use const FILTER_SANITIZE_EMAIL;
use const FILTER_VALIDATE_BOOLEAN;
use const FILTER_VALIDATE_DOMAIN;
use const FILTER_VALIDATE_EMAIL;
use const FILTER_VALIDATE_FLOAT;
use const FILTER_VALIDATE_INT;
use const FILTER_VALIDATE_URL;

#[Group('validator')]
#[CoversClass(FilterVar::class)]
final class FilterVarTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowsExceptionWhenFilterIsNotValid(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage('Cannot accept the given filter');

        new FilterVar(FILTER_SANITIZE_EMAIL);
    }

    /** @return iterable<array{FilterVar, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new FilterVar(FILTER_VALIDATE_INT), '12345'],
            [new FilterVar(FILTER_VALIDATE_EMAIL), 'example@example.com'],
            [new FilterVar(FILTER_VALIDATE_FLOAT), 1.5],
            [new FilterVar(FILTER_VALIDATE_BOOLEAN), 'On'],
            [new FilterVar(FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED), 'http://example.com?foo=bar'],
            [new FilterVar(FILTER_VALIDATE_DOMAIN), 'example.com'],
            [new FilterVar(FILTER_VALIDATE_INT), '0'],
        ];
    }

    /** @return iterable<array{FilterVar, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new FilterVar(FILTER_VALIDATE_INT), 1.4],
            [new FilterVar(FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED), 'http://example.com'],
            [new FilterVar(FILTER_VALIDATE_DOMAIN), '.com'],
            [new FilterVar(FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME), '@local'],
            [new FilterVar(FILTER_VALIDATE_INT, []), 1.4],
            [new FilterVar(FILTER_VALIDATE_INT, 2), 1.4],
        ];
    }
}
