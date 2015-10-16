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
 * @covers Respect\Validation\Rules\Bsn
 * @covers Respect\Validation\Exceptions\BsnException
 */
class BsnTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Bsn
     */
    private $rule;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rule = new Bsn();
    }

    /**
     * @dataProvider providerForBsn
     *
     * @param string $input
     */
    public function testShouldValidateBsn($input)
    {
        $this->assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForInvalidBsn
     * @expectedException \Respect\Validation\Exceptions\BsnException
     *
     * @param string $input
     */
    public function testShouldNotValidateBsn($input)
    {
        $this->assertFalse($this->rule->validate($input));
        $this->assertFalse($this->rule->assert($input));
    }

    /**
     * @return array
     */
    public function providerForBsn()
    {
        return array(
            array('612890053'),
            array('087880532'),
            array('386625918'),
            array('601608021'),
            array('254650703'),
            array('478063441'),
            array('478063441'),
            array('187368429'),
            array('541777348'),
            array('254283883'),
        );
    }

    /**
     * @return array
     */
    public function providerForInvalidBsn()
    {
        return array(
            array('1234567890'),
            array('0987654321'),
            array('13579024'),
            array('612890054'),
            array('854650703'),
            array('283958721'),
            array('231859081'),
            array('189023323'),
            array('238150912'),
            array('382409678'),
        );
    }
}
