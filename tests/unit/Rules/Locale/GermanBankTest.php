<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\LocaleTestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Locale\GermanBank
 * @covers Respect\Validation\Exceptions\Locale\GermanBankException
 */
class GermanBankTest extends LocaleTestCase
{
    public function testShouldAcceptBAVInstanceOnConstrutor()
    {
        $bav = $this->getBavMock();
        $rule = new GermanBank($bav);

        $this->assertSame($bav, $rule->bav);
    }

    public function testShouldHaveAnInstanceOfBAVByDefault()
    {
        $rule = new GermanBank();

        $this->assertInstanceOf('malkusch\bav\BAV', $rule->bav);
    }

    public function testShouldUseBAVInstanceToValidate()
    {
        $input = '10000000';
        $bav = $this->getBavMock();
        $rule = new GermanBank($bav);

        $bav->expects($this->once())
            ->method('isValidBank')
            ->with($input)
            ->will($this->returnValue(true));

        $rule->validate($input);
    }

    public function testShouldReturnBAVInstanceResulteWhenValidating()
    {
        $input = '10000000';
        $bav = $this->getBavMock();
        $rule = new GermanBank($bav);

        $bav->expects($this->any())
            ->method('isValidBank')
            ->with($input)
            ->will($this->returnValue(true));

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\Locale\GermanBankException
     * @expectedExceptionMessage "10000000" must be a german bank
     */
    public function testShouldThowsTheRightExceptionWhenChecking()
    {
        $input = '10000000';
        $bav = $this->getBavMock();
        $rule = new GermanBank($bav);

        $bav->expects($this->any())
            ->method('isValidBank')
            ->with($input)
            ->will($this->returnValue(false));

        $rule->check($input);
    }
}
