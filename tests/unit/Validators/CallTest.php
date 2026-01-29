<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Pathum Harshana De Silva <pathumhdes@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\RuleTestCase;
use TypeError;

#[Group('validator')]
#[CoversClass(Call::class)]
final class CallTest extends RuleTestCase
{
    /** @return iterable<string, array{Call, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            'callback true' => [new Call('strtolower', new Equals('abc')), 'ABC'],
        ];
    }

    /** @return iterable<string, array{Call, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            'callback false' => [new Call('strtolower', new Equals('abc')), 'DEF'],
        ];
    }

    #[Test]
    public function shouldLetErrorsEmittedByTheChosenProvidedCallbackToBubbleUp(): void
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('strtolower(): Argument #1 ($string) must be of type string, int given');
        $validator = new Call('strtolower', new Equals('abc'));
        $validator->evaluate(123);
    }
}
