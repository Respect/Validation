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
 * @covers \Respect\Validation\Rules\Luhn
 *
 * @author Alexander Gorshkov <mazanax@yandex.ru>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
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
            '17 digits string' => [$rule, '2222400041240011'],
            '16 digits string' => [$rule, '340316193809364'],
            'integer' => [$rule, 6011000990139424],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Luhn();

        return [
            'invalid string' => [$rule, '2222400041240021'],
            'invalid integer' => [$rule, 340316193809334],
            'float' => [$rule, 222240004124001.1],
            'boolean true' => [$rule, true],
            'boolean false' => [$rule, false],
            'empty' => [$rule, ''],
            'object' => [$rule, new stdClass()],
            'array' => [$rule, [2222400041240011]],
        ];
    }
}
