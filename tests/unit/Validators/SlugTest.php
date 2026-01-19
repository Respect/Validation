<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Carlos André Ferrari <caferrari@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Kleber Hamada Sato <kleberhs007@yahoo.com>
 * SPDX-FileContributor: Marcel dos Santos <marcelgsantos@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Slug::class)]
final class SlugTest extends RuleTestCase
{
    /** @return iterable<array{Slug, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new Slug();

        return [
            [$sut, 'o-rato-roeu-o-rei-de-roma'],
            [$sut, 'o-alganet-e-um-feio'],
            [$sut, 'a-e-i-o-u'],
            [$sut, 'anticonstitucionalissimamente'],
        ];
    }

    /** @return iterable<array{Slug, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new Slug();

        return [
            [$sut, ''],
            [$sut, 'o-alganet-é-um-feio'],
            [$sut, 'á-é-í-ó-ú'],
            [$sut, '-assim-nao-pode'],
            [$sut, 'assim-tambem-nao-'],
            [$sut, 'nem--assim'],
            [$sut, '--nem-assim'],
            [$sut, 'Nem mesmo Assim'],
            [$sut, 'Ou-ate-assim'],
            [$sut, '-Se juntar-tudo-Então-'],
            [$sut, 'eAssim-vai'],
            [$sut, '@-!teste-teste'],
            [$sut, '*teste-teste'],
            [$sut, 123],
            [$sut, []],
            [$sut, 123.321],
            [$sut, new stdClass()],
        ];
    }
}
