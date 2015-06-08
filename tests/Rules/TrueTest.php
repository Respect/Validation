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

class TrueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validTrueProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new True();

        $this->assertTrue($rule->validate($input));
    }

    public function validTrueProvider()
    {
        return array(
            array(true),
            array(1),
            array('1'),
            array('true'),
            array('on'),
            array('yes'),
        );
    }

    /**
     * @dataProvider invalidTrueProvider
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new True();

        $this->assertFalse($rule->validate($input));
    }

    public function invalidTrueProvider()
    {
        return array(
            array(false),
            array(0),
            array('0'),
            array('false'),
            array('off'),
            array('no'),
        );
    }
}
