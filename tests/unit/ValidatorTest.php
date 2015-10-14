<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testStaticCreateShouldReturnNewValidator()
    {
        $this->assertInstanceOf('Respect\Validation\Validator', Validator::create());
    }

    public function testInvalidRuleClassShouldThrowComponentException()
    {
        $this->setExpectedException('Respect\Validation\Exceptions\ComponentException');
        Validator::iDoNotExistSoIShouldThrowException();
    }

    /**
     * Regression test #174.
     */
    public function testShouldReturnValidatorInstanceWhenTheNotRuleIsCalledWithArguments()
    {
        $validator = new Validator();

        $this->assertSame($validator, $validator->not($validator->notEmpty()));
    }
}
