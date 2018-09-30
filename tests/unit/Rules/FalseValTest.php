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
use const PHP_INT_MAX;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\FalseVal
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FalseValTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $sut = new FalseVal();

        return [
            'boolean false' => [$sut, false],
            'empty string' => [$sut, ''],
            'integer 0' => [$sut, 0],
            '0' => [$sut, '0'],
            'false' => [$sut, 'false'],
            'FALSE' => [$sut, 'FALSE'],
            'False' => [$sut, 'False'],
            'no' => [$sut, 'no'],
            'NO' => [$sut, 'NO'],
            'No' => [$sut, 'No'],
            'off' => [$sut, 'off'],
            'OFF' => [$sut, 'OFF'],
            'Off' => [$sut, 'Off'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new FalseVal();

        return [
            'boolean true' => [$sut, true],
            'integer bigger than 1' => [$sut, random_int(1, PHP_INT_MAX)],
            'integer-string bigger than 1' => [$sut, (string) random_int(1, PHP_INT_MAX)],
            'float bigger than 0' => [$sut, 0.5],
            'true' => [$sut, 'true'],
            'on' => [$sut, 'on'],
            'yes' => [$sut, 'yes'],
            'anything' => [$sut, 'anything'],
            'empty array' => [$sut, []],
            'object' => [$sut, new stdClass()],
        ];
    }
}
