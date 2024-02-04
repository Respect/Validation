<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
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
