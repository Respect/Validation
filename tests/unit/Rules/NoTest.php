<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

use function setlocale;
use function sprintf;

use const LC_ALL;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\NoException
 * @covers \Respect\Validation\Rules\No
 */
final class NoTest extends RuleTestCase
{
    private string $locale;

    /**
     * @test
     * @dataProvider providerForValidInputWithLocale
     */
    public function itShouldValidateInputAccordingToTheLocale(string $locale, string $input): void
    {
        setlocale(LC_ALL, $locale);

        if ($locale !== setlocale(LC_ALL, '0')) {
            $this->markTestSkipped(sprintf('Could not set locale information to "%s"', $locale));
        }

        self::assertValidInput(new No(true), $input);
    }

    /**
     * @test
     * @dataProvider providerForInvalidInputWithLocale
     */
    public function itShouldInvalidateInputAccordingToTheLocale(string $locale, string $input): void
    {
        setlocale(LC_ALL, $locale);

        if ($locale !== setlocale(LC_ALL, '0')) {
            $this->markTestSkipped(sprintf('Could not set locale information to "%s"', $locale));
        }

        self::assertInvalidInput(new No(true), $input);
    }

    /**
     * @return string[][]
     */
    public static function providerForValidInputWithLocale(): array
    {
        return [
            'nl' => ['nl_NL.UTF-8', 'Nee'],
            'pt' => ['pt_BR.UTF-8', 'Não'],
            'ru' => ['ru_RU.UTF-8', 'нет'],
        ];
    }

    /**
     * @return string[][]
     */
    public static function providerForInvalidInputWithLocale(): array
    {
        return [
            'nl' => ['nl_NL.UTF-8', 'Ez'],
            'pt' => ['pt_BR.UTF-8', 'нет'],
            'ru' => ['pt_BR.UTF-8', 'Οχι'],
        ];
    }

    /**
     * @return array<array{No, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $sut = new No();

        return [
            [$sut, 'N'],
            [$sut, 'Nay'],
            [$sut, 'Nix'],
            [$sut, 'No'],
            [$sut, 'Nope'],
            [$sut, 'Not'],
        ];
    }

    /**
     * @return array<array{No, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $sut = new No();

        return [
            [$sut, 'Donnot'],
            [$sut, 'Never'],
            [$sut, 'Niet'],
            [$sut, 'Noooooooo'],
            [$sut, 'Não'],
        ];
    }

    protected function setUp(): void
    {
        $this->locale = (string) setlocale(LC_ALL, '0');
    }

    protected function tearDown(): void
    {
        setlocale(LC_ALL, $this->locale);
    }
}
