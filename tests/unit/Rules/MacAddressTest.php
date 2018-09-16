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
 * @covers \Respect\Validation\Rules\MacAddress
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Fábio da Silva Ribeiro <fabiorphp@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MacAddressTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new MacAddress();

        return [
            [$rule, '00:11:22:33:44:55'],
            [$rule, '66-77-88-99-aa-bb'],
            [$rule, 'AF:0F:bd:12:44:ba'],
            [$rule, '90-bc-d3-1a-dd-cc'],
        ];
    }

    /**
     * {@inheditdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new MacAddress();

        return [
            [$rule, ''],
            [$rule, '00-1122:33:44:55'],
            [$rule, '66-77--99-jj-bb'],
            [$rule, 'HH:0F-bd:12:44:ba'],
            [$rule, '90-bc-nk:1a-dd-cc'],
        ];
    }
}
