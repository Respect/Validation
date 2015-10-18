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
     * It is to provide constructor arguments and.
     *
     * @return array
     */
    public function providerForValidInput()
    {
        return [
            'int (all true)' => [
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                42,
            ],
            'bool (all true)' => [
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                true,
            ],
            'empty (all true)' => [
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                '',
            ],
            'object (all true)' => [
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                new \stdClass(),
            ],
            'empty array (all true)' => [
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                [],
            ],
            'not empty array (all true)' => [
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock()),
                ['test'],
            ],
            'when = true, then = false, else = true' => [
                new When($this->getRuleMock(), $this->getRuleMock(), $this->getRuleMock(false)),
                false,
            ],

        ];
    }

    /**
     * @return array
     */
    public function providerForInvalidInput()
    {
        return [
            'when = true, then = false, else = false' => [
                new When($this->getRuleMock(), $this->getRuleMock(false), $this->getRuleMock(false)),
                false,
            ],
            'when = true, then = false, else = true' => [
                new When($this->getRuleMock(), $this->getRuleMock(false), $this->getRuleMock()),
                false,
            ],
            'when = false, then = false, else = false' => [
                new When($this->getRuleMock(false), $this->getRuleMock(false), $this->getRuleMock(false)),
                false,
            ],
        ];
    }
}
