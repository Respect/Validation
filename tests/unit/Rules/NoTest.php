<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
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
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NoTest extends RuleTestCase
{
    /**
     * @var string
     */
    private $locale;

    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
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
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
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

    /**
     * @return string[][]
     */
    public function providerForValidInputWithLocale(): array
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
    public function providerForInvalidInputWithLocale(): array
    {
        return [
            'nl' => ['nl_NL.UTF-8', 'Ez'],
            'pt' => ['pt_BR.UTF-8', 'нет'],
            'ru' => ['pt_BR.UTF-8', 'Οχι'],
        ];
    }

    /**
     * @test
     *
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
     *
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
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->locale = (string) setlocale(LC_ALL, '0');
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        setlocale(LC_ALL, $this->locale);
    }
}
