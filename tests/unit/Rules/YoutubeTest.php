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
 * @covers Respect\Validation\Rules\Youtube
 * @covers Respect\Validation\Exceptions\YoutubeException
 */
class YoutubeTest extends \PHPUnit_Framework_TestCase
{
    protected $youtubeValidator;

    protected function setUp()
    {
        $this->youtubeValidator = new Youtube();
    }

    /**
     * @dataProvider providerForYoutube
     */
    public function testValidYoutubeShouldReturnTrue($input)
    {
        $this->assertTrue($this->youtubeValidator->__invoke($input));
        $this->assertTrue($this->youtubeValidator->assert($input));
        $this->assertTrue($this->youtubeValidator->check($input));
    }

    /**
     * @dataProvider providerForNotYoutube
     * @expectedException Respect\Validation\Exceptions\YoutubeException
     */
    public function testInvalidYoutubeShouldThrowYoutubeException($input)
    {
        $this->assertFalse($this->youtubeValidator->__invoke($input));
        $this->assertFalse($this->youtubeValidator->assert($input));
    }

    public function providerForYoutube()
    {
        return array(
            array(''),
            array('https://www.youtube.com/watch?v=netHLn9TScY'),
            array('https://youtu.be/netHLn9TScY'),
            array('https://www.youtube.com/embed/netHLn9TScY'),
        );
    }

    public function providerForNotYoutube()
    {
        return array(
            array('https://vimeo.com/71787467'),
            array('https://player.vimeo.com/video/71787467'),
            array('https://www.google.com'),
            array('example.com'),
            array('http:/example.com/'),
            array('tel:+1-816-555-1212'),
            array('text'),
        );
    }
}
