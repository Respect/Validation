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
 * @covers \Respect\Validation\Rules\BoolType
 *
 * @author Devin Torres <devin@devintorres.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BoolTypeTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new BoolType();

        return [
            [$rule, true],
            [$rule, false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new BoolType();

        return [
            [$rule, ''],
            [$rule, 'foo'],
            [$rule, 123123],
            [$rule, new stdClass()],
            [$rule, []],
            [$rule, 1],
            [$rule, 0],
            [$rule, null],
        ];
    }
}
