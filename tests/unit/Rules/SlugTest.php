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

use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Slug
 *
 * @author Carlos André Ferrari <caferrari@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Marcel dos Santos <marcelgsantos@gmail.com>
 */
class SlugTest extends TestCase
{
    /**
     * @dataProvider providerValidSlug
     *
     * @test
     */
    public function validSlug(string $input): void
    {
        $rule = new Slug();

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerInvalidSlug
     *
     * @test
     */
    public function invalidSlug(string $input): void
    {
        $rule = new Slug();

        self::assertFalse($rule->validate($input));
    }

    /**
     * @return string[][]
     */
    public function providerValidSlug(): array
    {
        return [
            ['o-rato-roeu-o-rei-de-roma'],
            ['o-alganet-e-um-feio'],
            ['a-e-i-o-u'],
            ['anticonstitucionalissimamente'],
        ];
    }

    /**
     * @return string[][]
     */
    public function providerInvalidSlug(): array
    {
        return [
            [''],
            ['o-alganet-é-um-feio'],
            ['á-é-í-ó-ú'],
            ['-assim-nao-pode'],
            ['assim-tambem-nao-'],
            ['nem--assim'],
            ['--nem-assim'],
            ['Nem mesmo Assim'],
            ['Ou-ate-assim'],
            ['-Se juntar-tudo-Então-'],
        ];
    }
}
