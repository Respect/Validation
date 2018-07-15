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
 * @covers \Respect\Validation\Rules\Multiple
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class MultipleTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Multiple(5), 20],
            [new Multiple(5), 5],
            [new Multiple(5), 0],
            [new Multiple(5), -500],
            [new Multiple(1), 0],
            [new Multiple(1), 1],
            [new Multiple(1), 2],
            [new Multiple(1), 3],
            [new Multiple(0), 0], // Only 0 is multiple of 0
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Multiple(5), 11],
            [new Multiple(5), 3],
            [new Multiple(5), -1],
            [new Multiple(3), 4],
            [new Multiple(10), -8],
            [new Multiple(10), 57],
            [new Multiple(10), 21],
            [new Multiple(0), 1],
            [new Multiple(0), 2],
        ];
    }
}
