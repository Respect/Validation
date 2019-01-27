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
 * @covers \Respect\Validation\Rules\Pesel
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Tomasz Regdos <tomek@regdos.com>
 */
final class PeselTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Pesel();

        return [
            [$rule, 0x4EADCD168], // 0x4EADCD168 === 21120209256
            [$rule, 49040501580],
            [$rule, '49040501580'],
            [$rule, '39012110375'],
            [$rule, '50083014540'],
            [$rule, '69090515504'],
            [$rule, '21120209256'],
            [$rule, '01320613891'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Pesel();

        return [
            [$rule, '1'],
            [$rule, '22'],
            [$rule, 'PESEL'],
            [$rule, '0x4EADCD168'],
            [$rule, 'PESEL123456'],
            [$rule, '690905155.4'],
            [$rule, '21120209251'],
            [$rule, '21120209250'],
            [$rule, '01320613890'],
        ];
    }
}
