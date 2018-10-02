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
        $rule = new FalseVal();

        return [
            '(bool) false' => [$rule, false],
            '(int) 0' => [$rule, 0],
            '(string) 0' => [$rule, '0'],
            '(string) false' => [$rule, 'false'],
            'off' => [$rule, 'off'],
            'no' => [$rule, 'no'],
            '(string) FALSE' => [$rule, 'FALSE'],
            'OFF' => [$rule, 'OFF'],
            'NO' => [$rule, 'NO'],
            '(string) False' => [$rule, 'False'],
            'Off' => [$rule, 'Off'],
            'No' => [$rule, 'No'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new FalseVal();

        return [
            '(bool) true' => [$rule, true],
            '(int) 1' => [$rule, 1],
            '(string) 1' => [$rule, '1'],
            '(float) 0.5' => [$rule, 0.5],
            '(int) 2' => [$rule, 2],
            '(string) true' => [$rule, 'true'],
            'on' => [$rule, 'on'],
            'yes' => [$rule, 'yes'],
            'anything' => [$rule, 'anything'],
        ];
    }
}
