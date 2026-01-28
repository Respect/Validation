<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: João Torquato <joao.otl@gmail.com>
 * SPDX-FileContributor: Justin Hook <justinhook88@yahoo.co.uk>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use DI;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\ContainerRegistry;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(CurrencyCode::class)]
final class CurrencyCodeTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowsExceptionWhenInvalidFormat(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage(
            '"whatever" is not a valid set for ISO 4217 (Available: "alpha-3" and "numeric")',
        );

        // @phpstan-ignore-next-line
        new CurrencyCode('whatever');
    }

    #[Test]
    public function shouldThrowWhenMissingComponent(): void
    {
        $mainContainer = ContainerRegistry::getContainer();
        ContainerRegistry::setContainer((new DI\ContainerBuilder())->useAutowiring(false)->build());
        try {
            new CurrencyCode('alpha-3');
            $this->fail('Expected MissingComposerDependencyException was not thrown.');
        } catch (MissingComposerDependencyException $e) {
            $this->assertStringContainsString(
                'CurrencyCode rule requires PHP ISO Codes',
                $e->getMessage(),
            );
        } finally {
            ContainerRegistry::setContainer($mainContainer);
        }
    }

    /** @return iterable<array{CurrencyCode, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new CurrencyCode(), 'EUR'],
            [new CurrencyCode('numeric'), '978'],
            [new CurrencyCode(), 'GBP'],
            [new CurrencyCode('numeric'), '826'],
            [new CurrencyCode(), 'XAU'],
            [new CurrencyCode('numeric'), '959'],
            [new CurrencyCode(), 'XBA'],
            [new CurrencyCode('numeric'), '955'],
            [new CurrencyCode(), 'XXX'],
            [new CurrencyCode('numeric'), '999'],
        ];
    }

    /** @return iterable<array{CurrencyCode, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new CurrencyCode(), ''],
            [new CurrencyCode('numeric'), '123'],
            [new CurrencyCode(), 'BTC'],
            [new CurrencyCode(), 'GGP'],
            [new CurrencyCode(), 'USA'],
        ];
    }
}
