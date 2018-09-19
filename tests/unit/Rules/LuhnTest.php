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
 * @covers \Respect\Validation\Rules\Luhn
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author mazanax <mazanax@yandex.ru>
 */
final class LuhnTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Luhn();

        return [
            [$rule, '2222400041240011'],
            [$rule, '340316193809364'],
            [$rule, '6011000990139424'],
            [$rule, '2223000048400011'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Luhn();

        return [
            [$rule, '2222400041240021'],
            [$rule, '340316193809334'],
            [$rule, '6011000990139421'],
            [$rule, '2223000048400010'],
        ];
    }
}
