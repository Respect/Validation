<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\RuleTestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\NfeAccessKey
 * @covers Respect\Validation\Exceptions\NfeAccessKeyException
 */
final class NfeAccessKeyTest extends RuleTestCase
{
    /**
     * @dataProvider providerForInvalidInput
     * @expectedException Respect\Validation\Exceptions\NfeAccessKeyException
     */
    public function testInvalidLengthCnh($validator, $input)
    {
        $this->assertFalse($validator->assert($input));
    }

    /**
     * @{inheritdoc}
     */
    public function providerForValidInput()
    {
        $rule = new NfeAccessKey();

        return [
            [$rule, '52060433009911002506550120000007800267301615'],
        ];
    }

    /**
     * @{inheritdoc}
     */
    public function providerForInvalidInput()
    {
        $rule = new NfeAccessKey();
        return [
            [$rule, '31841136830118868211870485416765268625116906'],
            [$rule, '21470801245862435081451225624565260861852679'],
            [$rule, '45644318091447671194616059650873352394885852'],
            [$rule, '17214281716057582143671174314277906696193888'],
            [$rule, '56017280182977836779696364362142515138726654'],
            [$rule, '90157126614010548506235171976891004177042525'],
            [$rule, '78457064241662300187501877048374851128754067'],
            [$rule, '39950148079977322431982386613620895568235903'],
            [$rule, '90820939577654114875253907311677136672761216'],
        ];
    }
}
