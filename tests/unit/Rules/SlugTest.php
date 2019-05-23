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

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Slug
 *
 * @author Carlos André Ferrari <caferrari@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Marcel dos Santos <marcelgsantos@gmail.com>
 */
final class SlugTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $sut = new Slug();

        return [
            [$sut, 'o-rato-roeu-o-rei-de-roma'],
            [$sut, 'o-alganet-e-um-feio'],
            [$sut, 'a-e-i-o-u'],
            [$sut, 'anticonstitucionalissimamente'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
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
