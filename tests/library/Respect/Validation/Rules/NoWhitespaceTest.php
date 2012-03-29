<?php

namespace Respect\Validation\Rules;

class NoWhitespaceTest extends \PHPUnit_Framework_TestCase
{

    protected $noWhitespaceValidator;

    protected function setUp()
    {
        $this->noWhitespaceValidator = new NoWhitespace;
    }

    public function test_string_with_no_whitespace_should_pass()
    {
        $this->assertTrue($this->noWhitespaceValidator->validate('wpoiur'));
        $this->assertTrue($this->noWhitespaceValidator->check('wpoiur'));
        $this->assertTrue($this->noWhitespaceValidator->assert('wpoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\NoWhitespaceException
     */
    public function test_string_with_whitespace_should_fail()
    {
        $this->assertFalse($this->noWhitespaceValidator->validate('w poiur'));
        $this->assertFalse($this->noWhitespaceValidator->assert('w poiur'));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\NoWhitespaceException
     */
    public function test_string_with_line_breaks_should_fail()
    {
        $this->assertFalse($this->noWhitespaceValidator->validate("w\npoiur"));
        $this->assertFalse($this->noWhitespaceValidator->assert("w\npoiur"));
    }

}
/**
 * LICENSE
 *
 * Copyright (c) 2009-2011, Alexandre Gomes Gaigalas.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *
 *     * Redistributions in binary form must reproduce the above copyright notice,
 *       this list of conditions and the following disclaimer in the documentation
 *       and/or other materials provided with the distribution.
 *
 *     * Neither the name of Alexandre Gomes Gaigalas nor the names of its
 *       contributors may be used to endorse or promote products derived from this
 *       software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */