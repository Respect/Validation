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
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $slug = new Slug();

        return [
            [$slug, 'o-rato-roeu-o-rei-de-roma'],
            [$slug, 'o-alganet-e-um-feio'],
            [$slug, 'a-e-i-o-u'],
            [$slug, 'anticonstitucionalissimamente'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $slug = new Slug();

        return [
            [$slug, ''],
            [$slug, 'o-alganet-é-um-feio'],
            [$slug, 'á-é-í-ó-ú'],
            [$slug, '-assim-nao-pode'],
            [$slug, 'assim-tambem-nao-'],
            [$slug, 'nem--assim'],
            [$slug, '--nem-assim'],
            [$slug, 'Nem mesmo Assim'],
            [$slug, 'Ou-ate-assim'],
            [$slug, '-Se juntar-tudo-Então-'],
            [$slug, 'eAssim-vai'],
            [$slug, '@-!teste-teste'],
            [$slug, '*teste-teste'],
            [$slug, 123],
            [$slug, []],
            [$slug, 123.321],
            [$slug, new stdClass()],
        ];
    }
}
