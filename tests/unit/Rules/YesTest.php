<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;
use const LC_ALL;
use const PHP_INT_MAX;
use function random_int;
use function setlocale;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Yes
 *
 * @author Cameron Hall <me@chall.id.au>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class YesTest extends RuleTestCase
{
    /**
     * @var string
     */
    private $locale;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->locale = setlocale(LC_ALL, 0);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        setlocale(LC_ALL, $this->locale);
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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

    public function providerForValidInputWithLocale(): array
    {
        return [
            'nl' => ['nl_NL.UTF-8', 'Ja'],
            'pt' => ['pt_BR.UTF-8', 'Sim'],
            'ru' => ['ru_RU.UTF-8', 'да'],
        ];
    }

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
     *
     * @param string $locale
     * @param string $input
     */
    public function itShouldValidateValidInputAccordingToTheLocale(string $locale, string $input): void
    {
        setlocale(LC_ALL, $locale);

        $rule = new Yes(true);

        self::assertEquals($locale, setlocale(LC_ALL, 0));
        self::assertTrue($rule->validate($input));
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidInputWithLocale
     *
     * @param string $locale
     * @param string $input
     */
    public function itShouldValidateInvalidInputAccordingToTheLocale(string $locale, string $input): void
    {
        setlocale(LC_ALL, $locale);

        $rule = new Yes(true);

        self::assertEquals($locale, setlocale(LC_ALL, 0));
        self::assertFalse($rule->validate($input));
    }
}
