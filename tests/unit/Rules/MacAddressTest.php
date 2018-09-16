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
use const PHP_INT_MAX;
use function random_int;
use function tmpfile;

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
        $sut = new MacAddress();

        return [
            [$sut, '00:11:22:33:44:55'],
            [$sut, '66-77-88-99-aa-bb'],
            [$sut, 'AF:0F:bd:12:44:ba'],
            [$sut, '90-bc-d3-1a-dd-cc'],
        ];
    }

    /**
     * {@inheditdoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new MacAddress();

        return [
            'empty string' => [$sut, ''],
            'invalid MAC address' => [$sut, '00-1122:33:44:55'],
            'boolean' => [$sut, true],
            'array' => [$sut, ['90-bc-d3-1a-dd-cc']],
            'int' => [$sut, random_int(1, PHP_INT_MAX)],
            'float' => [$sut, random_int(1, 9) / 10],
            'null' => [$sut, null],
            'resource' => [$sut, tmpfile()],
            'callable' => [$sut, function (): void {}],
        ];
    }
}
