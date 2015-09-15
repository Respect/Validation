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
 * @covers Respect\Validation\Rules\Video
 * @covers Respect\Validation\Exceptions\VideoException
 */
class VideoTest extends \PHPUnit_Framework_TestCase
{
    protected $videoValidator;

    protected function setUp()
    {
        $this->videoValidator = new Video();
    }

    /**
     * @dataProvider providerForVideo
     */
    public function testValidVideoShouldReturnTrue($input)
    {
        $this->assertTrue($this->videoValidator->__invoke($input));
        $this->assertTrue($this->videoValidator->assert($input));
        $this->assertTrue($this->videoValidator->check($input));
    }

    /**
     * @dataProvider providerForNotVideo
     * @expectedException Respect\Validation\Exceptions\VideoException
     */
    public function testInvalidVideoShouldThrowVideoException($input)
    {
        $this->assertFalse($this->videoValidator->__invoke($input));
        $this->assertFalse($this->videoValidator->assert($input));
    }

    public function providerForVideo()
    {
        return array(
            array(''),
            array('https://www.youtube.com/watch?v=netHLn9TScY'),
            array('https://youtu.be/netHLn9TScY'),
            array('https://www.youtube.com/embed/netHLn9TScY'),
            array('https://vimeo.com/71787467'),
            array('https://player.vimeo.com/video/71787467'),
        );
    }

    public function providerForNotVideo()
    {
        return array(
            array('https://www.google.com'),
            array('example.com'),
            array('http:/example.com/'),
            array('tel:+1-816-555-1212'),
            array('text'),
        );
    }
}
