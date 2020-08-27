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
use stdClass;

use function random_int;
use function setlocale;
use function sprintf;

use const LC_ALL;
use const PHP_INT_MAX;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Yes
 *
 * @author Cameron Hall <me@chall.id.au>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class YesTest extends RuleTestCase
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
        $sut = new Yes();

        return [
            'Y' => [$sut, 'Y'],
            'Yea' => [$sut, 'Yea'],
            'Yeah' => [$sut, 'Yeah'],
            'Yep' => [$sut, 'Yep'],
            'Yes' => [$sut, 'Yes'],
            'with locale + starting with "Y"' => [new Yes(true), 'Yydoesnotmatter'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new Yes();

        return [
            'spanish' => [$sut, 'Si'],
            'portuguese' => [$sut, 'Sim'],
            'starting with "Y"' => [$sut, 'Yoo'],
            'boolean true' => [$sut, true],
            'array' => [$sut, ['Yes']],
            'object' => [$sut, new stdClass()],
            'int' => [$sut, random_int(1, PHP_INT_MAX)],
            'float' => [$sut, random_int(1, 9) / 10],
        ];
    }

    /**
     * @return string[][]
     */
    public function providerForValidInputWithLocale(): array
    {
        return [
            'nl' => ['nl_NL.UTF-8', 'Ja'],
            'pt' => ['pt_BR.UTF-8', 'Sim'],
            'ru' => ['ru_RU.UTF-8', 'да'],
        ];
    }

    /**
     * @return string[][]
     */
    public function providerForInvalidInputWithLocale(): array
    {
        return [
            'nl' => ['nl_NL.UTF-8', 'Sim'],
            'pt' => ['pt_BR.UTF-8', 'да'],
            'ru' => ['ru_RU.UTF-8', 'Ja'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider providerForValidInputWithLocale
     */
    public function itShouldValidateValidInputAccordingToTheLocale(string $locale, string $input): void
    {
        setlocale(LC_ALL, $locale);

        if ($locale !== setlocale(LC_ALL, '0')) {
            $this->markTestSkipped(sprintf('Could not set locale information to "%s"', $locale));
        }

        self::assertValidInput(new Yes(true), $input);
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidInputWithLocale
     */
    public function itShouldValidateInvalidInputAccordingToTheLocale(string $locale, string $input): void
    {
        setlocale(LC_ALL, $locale);

        if ($locale !== setlocale(LC_ALL, '0')) {
            $this->markTestSkipped(sprintf('Could not set locale information to "%s"', $locale));
        }

        self::assertInvalidInput(new Yes(true), $input);
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
