<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Felipe Martins <me@fefas.net>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Config\Container;
use Respect\Validation\ContainerRegistry;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(CountryCode::class)]
final class CountryCodeTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowsExceptionWhenInvalidFormat(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage(
            '"whatever" is not a valid set for ISO 3166-1 (Available: "alpha-2", "alpha-3", and "numeric")',
        );

        // @phpstan-ignore-next-line
        new CountryCode('whatever');
    }

    #[Test]
    public function shouldThrowWhenMissingComponent(): void
    {
        ContainerRegistry::setContainer(new Container());
        try {
            new CountryCode('alpha-3');
            $this->fail('Expected MissingComposerDependencyException was not thrown.');
        } catch (MissingComposerDependencyException $e) {
            $this->assertStringContainsString(
                'CountryCode rule requires PHP ISO Codes',
                $e->getMessage(),
            );
        } finally {
            ContainerRegistry::resetContainer();
        }
    }

    /** @return iterable<array{CountryCode, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new CountryCode('alpha-2'),  'BR'],
            [new CountryCode('alpha-3'),  'BRA'],
            [new CountryCode('numeric'), '076'],
            [new CountryCode('alpha-2'),  'DE'],
            [new CountryCode('alpha-3'),  'DEU'],
            [new CountryCode('numeric'), '276'],
            [new CountryCode('alpha-2'),  'US'],
            [new CountryCode('alpha-3'),  'USA'],
            [new CountryCode('numeric'), '840'],
        ];
    }

    /** @return iterable<array{CountryCode, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new CountryCode(), []],
            [new CountryCode(), 'ca'],
            [new CountryCode('alpha-2'),  'USA'],
            [new CountryCode('alpha-3'),  'US'],
            [new CountryCode('numeric'), '000'],
        ];
    }
}
