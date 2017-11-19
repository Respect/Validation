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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Slug
 */
class SlugTest extends TestCase
{
    /**
     * @dataProvider providerValidSlug
     */
    public function testValidSlug($input): void
    {
        $rule = new Slug();

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerInvalidSlug
     */
    public function testInvalidSlug($input): void
    {
        $rule = new Slug();

        self::assertFalse($rule->validate($input));
    }

    public function providerValidSlug()
    {
        return [
            ['o-rato-roeu-o-rei-de-roma'],
            ['o-alganet-e-um-feio'],
            ['a-e-i-o-u'],
            ['anticonstitucionalissimamente'],
        ];
    }

    public function providerInvalidSlug()
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
