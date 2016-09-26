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

use PHPUnit_Framework_TestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Nif
 * @covers Respect\Validation\Exceptions\NifException
 */
class NifTest extends PHPUnit_Framework_TestCase
{
    const VALID = 'valid';
    const INVALID = 'invalid';

    /**
     * @var Bsn
     */
    private $rule;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rule = new Nif();
    }

    /**
     * @dataProvider providerForNif
     *
     * @param string $input
     */
    public function testShouldValidateNif($input, $validity)
    {
        if ($validity === static::VALID) {
            self::assertTrue($this->rule->validate($input));
        } else {
            self::assertFalse($this->rule->validate($input));
        }
    }

    /**
     * @return array
     */
    public function providerForNif()
    {
        return [
            // DNI
            ['71110316C', static::VALID],
            ['99977944A', static::VALID],
            ['70963442R', static::VALID],
            ['49294492H', static::VALID],
            ['11381116A', static::VALID],
            ['36822315D', static::INVALID],
            ['43901481F', static::INVALID],
            ['67931854U', static::INVALID],
            ['20890122T', static::INVALID],
            ['28799818A', static::INVALID],

            // NIE
            ['X0425894A', static::VALID],
            ['Y4819664M', static::VALID],
            ['Y7407711T', static::VALID],
            ['Y1168744J', static::VALID],
            ['Y1168744J', static::VALID],
            ['Y3012039X', static::INVALID],
            ['Z2448415H', static::INVALID],
            ['Y7225582L', static::INVALID],
            ['Y9613245P', static::INVALID],
            ['X3155250B', static::INVALID],

            // CIF
            ['V8002614I', static::VALID],
            ['R1332622H', static::VALID],
            ['Q6771656C', static::VALID],
            ['F3148958F', static::VALID],
            ['Q8703717B', static::VALID],
            ['C0325664D', static::INVALID],
            ['R27038239', static::INVALID],
            ['P6437358A', static::INVALID],
            ['W9188340B', static::INVALID],
            ['E05172860', static::INVALID],
        ];
    }
}
