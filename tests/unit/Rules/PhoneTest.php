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
 * @covers \Respect\Validation\Rules\Phone
 * @covers \Respect\Validation\Exceptions\PhoneException
 */
class PhoneTest extends \PHPUnit_Framework_TestCase
{
    protected $phoneValidator;

    protected function setUp()
    {
        $this->phoneValidator = new Phone();
    }

    /**
     * @dataProvider providerForPhone
     */
    public function testValidPhoneShouldReturnTrue($input)
    {
        $this->assertTrue($this->phoneValidator->__invoke($input));
        $this->assertTrue($this->phoneValidator->assert($input));
        $this->assertTrue($this->phoneValidator->check($input));
    }

    /**
     * @dataProvider providerForNotPhone
     * @expectedException \Respect\Validation\Exceptions\PhoneException
     */
    public function testInvalidPhoneShouldThrowPhoneException($input)
    {
        $this->assertFalse($this->phoneValidator->__invoke($input));
        $this->assertFalse($this->phoneValidator->assert($input));
    }

    public function providerForPhone()
    {
        return [
            ['+5-555-555-5555'],
            ['+5 555 555 5555'],
            ['+5.555.555.5555'],
            ['5-555-555-5555'],
            ['5.555.555.5555'],
            ['5 555 555 5555'],
            ['555.555.5555'],
            ['555 555 5555'],
            ['555-555-5555'],
            ['555-5555555'],
            ['5(555)555.5555'],
            ['+5(555)555.5555'],
            ['+5(555)555 5555'],
            ['+5(555)555-5555'],
            ['+5(555)5555555'],
            ['(555)5555555'],
            ['(555)555.5555'],
            ['(555)555-5555'],
            ['(555) 555 5555'],
            ['55555555555'],
            ['5555555555'],
            ['+33(1)2222222'],
            ['+33(1)222 2222'],
            ['+33(1)222.2222'],
            ['+33(1)22 22 22 22'],
            ['33(1)2222222'],
            ['33(1)22222222'],
            ['33(1)22 22 22 22'],
            ['(020) 7476 4026'],
            ['33(020) 7777 7777'],
            ['33(020)7777 7777'],
            ['+33(020) 7777 7777'],
            ['+33(020)7777 7777'],
            ['03-6106666'],
            ['036106666'],
            ['+33(11) 97777 7777'],
            ['+3311977777777'],
            ['11977777777'],
            ['11 97777 7777'],
            ['(11) 97777 7777'],
            ['(11) 97777-7777'],
            ['555-5555'],
            ['5555555'],
            ['555.5555'],
            ['555 5555'],
        ];
    }

    public function providerForNotPhone()
    {
        return [
            [''],
            ['123'],
            ['s555-5555'],
            ['555-555'],
            ['555555'],
            ['555+5555'],
            ['(555)555555'],
            ['(555)55555'],
            ['+(555)555 555'],
            ['+5(555)555 555'],
            ['+5(555)555 555 555'],
            ['555)555 555'],
            ['+5(555)5555 555'],
            ['(555)55 555'],
            ['(555)5555 555'],
            ['+5(555)555555'],
            ['5(555)55 55555'],
            ['(5)555555'],
            ['+55(5)55 5 55 55'],
            ['+55(5)55 55 55 5'],
            ['+55(5)55 55 55'],
            ['+55(5)5555 555'],
            ['+55()555 5555'],
            ['03610666-5'],
            ['text'],
        ];
    }
}
