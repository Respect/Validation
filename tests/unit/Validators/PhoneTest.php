<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Eduardo Reveles <me@osiux.ws>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Henrique Oliveira <henrique.oliveira83@yahoo.com.br>
 * SPDX-FileContributor: mf <michael.firsikov@gmail.com>
 * SPDX-FileContributor: RCooLeR <roman.derevianko@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use libphonenumber\PhoneNumberUtil;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Config\Container;
use Respect\Validation\ContainerRegistry;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Test\TestCase;
use Sokil\IsoCodes\Database\Countries;
use stdClass;

#[Group('validator')]
#[CoversClass(Phone::class)]
final class PhoneTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForValidInputWithoutCountryCode')]
    public function shouldValidateValidInputWithoutCountryCode(mixed $input): void
    {
        self::assertValidInput(new Phone(), $input);
    }

    #[Test]
    #[DataProvider('providerForInvalidInputWithoutCountryCode')]
    public function shouldValidateInvalidInputWithoutCountryCode(mixed $input): void
    {
        self::assertInvalidInput(new Phone(), $input);
    }

    #[Test]
    #[DataProvider('providerForValidInputWithCountryCode')]
    public function shouldValidateValidInputWithCountryCode(string $countryCode, mixed $input): void
    {
        self::assertValidInput(new Phone($countryCode), $input);
    }

    #[Test]
    #[DataProvider('providerForInvalidInputWithCountryCode')]
    public function shouldValidateInvalidInputWithCountryCode(string $countryCode, mixed $input): void
    {
        self::assertInvalidInput(new Phone($countryCode), $input);
    }

    #[Test]
    public function itShouldThrowsExceptionWhenCountryCodeIsNotValid(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage('Invalid country code BRR');

        new Phone('BRR');
    }

    #[Test]
    public function shouldThrowWhenMissingIsocodesComponent(): void
    {
        $container = new Container();
        $container[PhoneNumberUtil::class] = static fn() => PhoneNumberUtil::getInstance();
        ContainerRegistry::setContainer($container);
        try {
            new Phone('US');
            $this->fail('Expected MissingComposerDependencyException was not thrown.');
        } catch (MissingComposerDependencyException $e) {
            $this->assertStringContainsString(
                'Phone rule with country code requires PHP ISO Codes',
                $e->getMessage(),
            );
        } finally {
            ContainerRegistry::resetContainer();
        }
    }

    #[Test]
    public function shouldThrowWhenMissingPhonesComponent(): void
    {
        $container = new Container();
        $container[Countries::class] = static fn() => new Countries();
        ContainerRegistry::setContainer($container);
        try {
            new Phone('US');
            $this->fail('Expected MissingComposerDependencyException was not thrown.');
        } catch (MissingComposerDependencyException $e) {
            $this->assertStringContainsString(
                'Phone rule requires libphonenumber for PHP.',
                $e->getMessage(),
            );
        } finally {
            ContainerRegistry::resetContainer();
        }
    }

    /** @return array<array{mixed}> */
    public static function providerForValidInputWithoutCountryCode(): array
    {
        return [
            ['+1 650 253 00 00'],
            ['+7 (999) 999-99-99'],
            ['+7(999)999-99-99'],
            ['+7(999)999-9999'],
            ['+33(1)22 22 22 22'],
            ['+1 650 253 00 00'],
            ['+7 (999) 999-99-99'],
            ['+7(999)999-99-99'],
            ['+7(999)999-9999'],
        ];
    }

    /** @return array<array{mixed}> */
    public static function providerForInvalidInputWithoutCountryCode(): array
    {
        return [
            [null],
            [new stdClass()],
            ['+1-650-253-00-0'],
            ['33(020) 7777 7777'],
            ['33(020)7777 7777'],
            ['+33(020) 7777 7777'],
            ['+33(020)7777 7777'],
            ['03-6106666'],
            ['036106666'],
            ['+33(11) 97777 7777'],
            ['+3311977777777'],
            ['11977777777'],
            ['11 97777 7777'],
            ['(11) 97777 7777'],
            ['(11) 97777-7777'],
            ['555-5555'],
            ['5555555'],
            ['555.5555'],
            ['555 5555'],
            ['+1 (555) 555 5555'],
            ['33(1)2222222'],
            ['33(1)22222222'],
            ['33(1)22 22 22 22'],
            ['(020) 7476 4026'],
            ['+5-555-555-5555'],
            ['+5 555 555 5555'],
            ['+5.555.555.5555'],
            ['5-555-555-5555'],
            ['5.555.555.5555'],
            ['5 555 555 5555'],
            ['555.555.5555'],
            ['555 555 5555'],
            ['555-555-5555'],
            ['555-5555555'],
            ['5(555)555.5555'],
            ['+5(555)555.5555'],
            ['+5(555)555 5555'],
            ['+5(555)555-5555'],
            ['+5(555)5555555'],
            ['(555)5555555'],
            ['(555)555.5555'],
            ['(555)555-5555'],
            ['(555) 555 5555'],
            ['55555555555'],
            ['5555555555'],
            ['+33(1)2222222'],
            ['+33(1)222 2222'],
            ['+33(1)222.2222'],
        ];
    }

    /** @return array<array{string, mixed}> */
    public static function providerForValidInputWithCountryCode(): array
    {
        return [
            ['BR', '+55 11 91111 1111'],
            ['BR', '11 91111 1111'],
            ['BR', '+5511911111111'],
            ['BR', '11911111111'],
            ['NL', '+31 10 408 1775'],
        ];
    }

    /** @return array<array{string, mixed}> */
    public static function providerForInvalidInputWithCountryCode(): array
    {
        return [
            ['BR', '+1 11 91111 1111'],
            ['BR', '+1 650 253 00 00'],
            ['US', '+31 10 408 1775'],
        ];
    }
}
