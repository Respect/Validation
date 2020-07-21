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

use const INF;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Even
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class EvenTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Even(), 2],
            [new Even(), -2],
            [new Even(), 0],
            [new Even(), 32],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Even(), ''],
            [new Even(), INF],
            [new Even(), 2.2],
            [new Even(), -5],
            [new Even(), -1],
            [new Even(), 1],
            [new Even(), 13],
        ];
    }
}
