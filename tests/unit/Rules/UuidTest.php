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
 * @group  rule
 * @covers \Respect\Validation\Rules\Uuid
 */
class UuidTest extends RuleTestCase
{
    public function providerForValidInput(): array
    {
        $rule = new Uuid();

        return [
            // Version 1
            [$rule, 'a71a18f4-3a13-11e7-a919-92ebcb67fe33'],
            [$rule, 'afa0eb06-3a13-11e7-a919-92ebcb67fe33'],
            [$rule, 'b46e09d4-3a13-11e7-a919-92ebcb67fe33'],
            // Version 4
            [$rule, '541b0e81-7afe-4fc4-a5f7-c01e9150df00'],
            [$rule, '2481103e-2cd1-4c7a-b4c9-19defde3dd94'],
            [$rule, '74077441-ea55-478a-a6f2-7dcd92239645'],
        ];
    }

    public function providerForInvalidInput(): array
    {
        $rule = new Uuid();

        return [
            // Nil/Empty UUID
            [$rule, '00000000-0000-0000-0000-000000000000'],
            // Text
            [$rule, 'Not a UUID'],
            // Invalid UUID's
            [$rule, 'g71a18f4-3a13-11e7-a919-92ebcb67fe33'],
            [$rule, 'a71a18f4-3g13-11e7-a919-92ebcb67fe33'],
            [$rule, 'a71a18f4-3a13-11g7-a919-92ebcb67fe33'],
            [$rule, 'a71a18f4-3a13-11e7-g919-92ebcb67fe33'],
            [$rule, 'a71a18f4-3a13-11e7-a919-92gbcb67fe33'],
        ];
    }
}
