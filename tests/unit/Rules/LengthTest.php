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

/**
 * @group  rule
 *
 * @covers \Respect\Validation\Exceptions\LengthException
 * @covers \Respect\Validation\Rules\Length
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Augusto Pascutti <contato@augustopascutti.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LengthTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Length(1, 15, true), 'alganet'],
            [new Length(4, 6, true), 'ççççç'],
            [new Length(1, 30, true), range(1, 20)],
            [new Length(0, 2, true), (object) ['foo' => 'bar', 'bar' => 'baz']],
            [new Length(1, null, true), 'alganet'], //null is a valid max length, means "no maximum",
            [new Length(null, 15, true), 'alganet'], //null is a valid min length, means "no minimum"
            [new Length(1, 15, false), 'alganet'],
            [new Length(4, 6, false), 'ççççç'],
            [new Length(1, 30, false), range(1, 20)],
            [new Length(1, 3, false), (object) ['foo' => 'bar', 'bar' => 'baz']],
            [new Length(1, null, false), 'alganet'], //null is a valid max length, means "no maximum",
            [new Length(null, 15, false), 'alganet'], //null is a valid min length, means "no minimum"
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Length(1, 15, true), ''],
            [new Length(1, 6, true), 'alganet'],
            [new Length(1, 19, true), range(1, 20)],
            [new Length(8, null, true), 'alganet'], //null is a valid max length, means "no maximum",
            [new Length(null, 6, true), 'alganet'], //null is a valid min length, means "no minimum"
            [new Length(1, 7, false), 'alganet'],
            [new Length(3, 5, false), (object) ['foo' => 'bar', 'bar' => 'baz']],
            [new Length(1, 30, false), range(1, 50)],
        ];
    }
}
