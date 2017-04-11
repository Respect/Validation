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

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Nif
 *
 * @author Julián Gutiérrez <juliangut@gmail.com>
 */
final class NifTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput()
    {
        $rule = new Nif();

        return [
            // DNI
            [$rule, '71110316C'],
            [$rule, '99977944A'],
            [$rule, '70963442R'],
            [$rule, '49294492H'],
            [$rule, '11381116A'],

            // NIE
            [$rule, 'X0425894A'],
            [$rule, 'Y4819664M'],
            [$rule, 'Y7407711T'],
            [$rule, 'Y1168744J'],
            [$rule, 'Y1168744J'],

            // CIF            
            [$rule, 'B56109770'],
            [$rule, 'V8002614I'],
            [$rule, 'R1332622H'],
            [$rule, 'Q6771656C'],
            [$rule, 'F3148958F'],
            [$rule, 'Q8703717B'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput()
    {
        $rule = new Nif();

        return [
            // DNI
            [$rule, '71110316c'],
            [$rule, '36822315D'],
            [$rule, '43901481F'],
            [$rule, '67931854U'],
            [$rule, '20890122T'],
            [$rule, '28799818A'],

            // NIE
            [$rule, 'x0425894a'],
            [$rule, 'Y3012039X'],
            [$rule, 'Z2448415H'],
            [$rule, 'Y7225582L'],
            [$rule, 'Y9613245P'],
            [$rule, 'X3155250B'],

            // CIF
            [$rule, 'B56109771'],
            [$rule, 'v8002614i'],
            [$rule, 'C0325664D'],
            [$rule, 'R27038239'],
            [$rule, 'P6437358A'],
            [$rule, 'W9188340B'],
            [$rule, 'E05172860'],

            // No regex match
            [$rule, ''],
            [$rule, 'I05172860'],
            [$rule, 'T2448415H'],

            // Weird types
            [$rule, []],
            [$rule, true],
            [$rule, 1],
            [$rule, 0.5],
            [$rule, null],
            [$rule, new \stdClass()],
            [$rule, stream_context_create()],
        ];
    }
}
