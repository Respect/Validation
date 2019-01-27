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
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Bsn
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ronald Drenth <ronalddrenth@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class BsnTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Bsn();

        return [
            [$rule, '612890053'],
            [$rule, '087880532'],
            [$rule, '386625918'],
            [$rule, '601608021'],
            [$rule, '254650703'],
            [$rule, '478063441'],
            [$rule, '478063441'],
            [$rule, '187368429'],
            [$rule, '541777348'],
            [$rule, '254283883'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Bsn();

        return [
            [$rule, '1234567890'],
            [$rule, '0987654321'],
            [$rule, '13579024'],
            [$rule, '612890054'],
            [$rule, '854650703'],
            [$rule, '283958721'],
            [$rule, '231859081'],
            [$rule, '189023323'],
            [$rule, '238150912'],
            [$rule, '382409678'],
            [$rule, '38240.678'],
            [$rule, '38240a678'],
            [$rule, 'abcdefghi'],
        ];
    }
}
