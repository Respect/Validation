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

use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\When
 * @covers Respect\Validation\Exceptions\WhenException
 */
class WhenTest extends RuleTestCase
{
    public function testShouldConstructAnObjectWithoutElseRule()
    {
        $v = new When($this->getRuleMock(), $this->getRuleMock());
        $this->assertInstanceOf('\Respect\Validation\Rules\AlwaysInvalid', $v->else);
    }

    public function testShouldConstructAnObjectWithElseRule()
    {
        $v = new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock());
        $this->assertNotNull($v->else);
    }

    /**
     * It is to provide constructor arguments and
     * @return array
     */
    public function providerForValidInput()
    {
        return array(
            'int (all true)' => array(
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                42
            ),
            'bool (all true)' => array(
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                true
            ),
            'empty (all true)' => array(
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                ''
            ),
            'object (all true)' => array(
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                new \stdClass()
            ),
            'empty array (all true)' => array(
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                array()
            ),
            'not empty array (all true)' => array(
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                array('test')
            ),
            'when = true, then = false, else = true' => array(
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock(false)),
                false
            ),

        );
    }

    /**
     * @return array
     */
    public function providerForInvalidInput()
    {
        return array(
            'when = true, then = false, else = false' => array(
                new When($this->getRuleMock(), $this->getRuleMock(false), $this->getRuleMock(false)),
                false
            ),
            'when = true, then = false, else = true' => array(
                new When($this->getRuleMock(), $this->getRuleMock(false), $this->getRuleMock()),
                false
            ),
            'when = false, then = false, else = false' => array(
                new When($this->getRuleMock(false), $this->getRuleMock(false), $this->getRuleMock(false)),
                false
            ),
        );
    }
}
