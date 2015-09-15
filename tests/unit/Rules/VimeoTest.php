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
 * @covers Respect\Validation\Rules\Vimeo
 * @covers Respect\Validation\Exceptions\VimeoException
 */
class VimeoTest extends \PHPUnit_Framework_TestCase
{
    protected $vimeoValidator;

    protected function setUp()
    {
        $this->vimeoValidator = new Vimeo();
    }

    /**
     * @dataProvider providerForVimeo
     */
    public function testValidVimeoShouldReturnTrue($input)
    {
        $this->assertTrue($this->vimeoValidator->__invoke($input));
        $this->assertTrue($this->vimeoValidator->assert($input));
        $this->assertTrue($this->vimeoValidator->check($input));
    }

    /**
     * @dataProvider providerForNotVimeo
     * @expectedException Respect\Validation\Exceptions\VimeoException
     */
    public function testInvalidVimeoShouldThrowVimeoException($input)
    {
        $this->assertFalse($this->vimeoValidator->__invoke($input));
        $this->assertFalse($this->vimeoValidator->assert($input));
    }

    public function providerForVimeo()
    {
        return array(
            array(''),
            array('https://vimeo.com/71787467'),
            array('https://player.vimeo.com/video/71787467'),
        );
    }

    public function providerForNotVimeo()
    {
        return array(
            array('https://www.youtube.com/watch?v=netHLn9TScY'),
            array('https://youtu.be/netHLn9TScY'),
            array('https://www.youtube.com/embed/netHLn9TScY'),
            array('https://www.google.com'),
            array('example.com'),
            array('http:/example.com/'),
            array('tel:+1-816-555-1212'),
            array('text'),
        );
    }
}
