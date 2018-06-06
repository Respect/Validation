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
 * @covers \Respect\Validation\Rules\Odd
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class OddTest extends RuleTestCase
{
    /*
    * {@inheritdoc}
    */
    public function providerForValidInput(): array
    {
        $rule = new Odd();

        return [
            [$rule, -5],
            [$rule, -1],
            [$rule, 1],
            [$rule, 13],
        ];
    }

    /*
    * {@inheritdoc}
    */
    public function providerForInvalidInput(): array
    {
        $rule = new Odd();

        return [
            [$rule, ''],
            [$rule, -2],
            [$rule, -0],
            [$rule, 0],
            [$rule, 32],
        ];
    }
}
