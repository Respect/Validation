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
 * @covers \Respect\Validation\Rules\NumericVal
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Augusto Pascutti <contato@augustopascutti.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NumericValTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $numericVal = new NumericVal();

        return [
            [$numericVal, 164],
            [$numericVal, 165.0],
            [$numericVal, -165],
            [$numericVal, '165'],
            [$numericVal, '165.0'],
            [$numericVal, '+165.0'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $numericVal = new NumericVal();

        return [
            [$numericVal, ''],
            [$numericVal, null],
            [$numericVal, 'a'],
            [$numericVal, ' '],
            [$numericVal, 'Foo'],
        ];
    }
}
