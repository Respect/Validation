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
 * @covers \Respect\Validation\Rules\TrueVal
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class TrueValTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new TrueVal();

        return [
            [$rule, true],
            [$rule, 1],
            [$rule, '1'],
            [$rule, 'true'],
            [$rule, 'on'],
            [$rule, 'yes'],
            [$rule, 'TRUE'],
            [$rule, 'ON'],
            [$rule, 'YES'],
            [$rule, 'True'],
            [$rule, 'On'],
            [$rule, 'Yes'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new TrueVal();

        return [
            [$rule, false],
            [$rule, 0],
            [$rule, 0.5],
            [$rule, 2],
            [$rule, '0'],
            [$rule, 'false'],
            [$rule, 'off'],
            [$rule, 'no'],
            [$rule, 'truth'],
        ];
    }
}
