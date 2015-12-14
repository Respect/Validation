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
 */
class ImageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidInput
     */
    public function testValidImageUrlShouldValidate($input)
    {
        $instance = new Image();
        $this->assertTrue($instance->validate($input));
    }

    /**
     * @dataProvider providerForInvalidInput
     */
    public function testInvalidImageUrlShouldNotValidate($input)
    {
        $instance = new Image();
        $this->assertFalse($instance->validate($input));
    }    

    public function providerForValidInput()
    {
        return [
            [__DIR__.'/../../fixtures/image_test.jpg'],
        ];
    }

    public function providerForInvalidInput()
    {
        return [
            [1],
            ['asdf'],
            [true],
        ];
    }
}
