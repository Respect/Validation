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
 * @covers Respect\Validation\Rules\VideoUrl
 * @covers Respect\Validation\Exceptions\VideoUrlException
 */
class VideoUrlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "teste" is not a recognized video url provider.
     */
    public function testShouldThrowsAnExceptionWhenProviderIsNotValid()
    {
        new VideoUrl('teste');
    }

    public function validVideoUrlProvider()
    {
        return array(
            // Valid data
            array('youtube', 'https://www.youtube.com/watch?v=netHLn9TScY', true),
            array('youtube', 'https://youtu.be/netHLn9TScY', true),
            array('youtube', 'https://www.youtube.com/embed/netHLn9TScY', true),
            array('vimeo', 'https://vimeo.com/71787467', true),
            array('vimeo', 'https://player.vimeo.com/video/71787467', true),
            array(array('youtube', 'vimeo'), 'https://www.youtube.com/watch?v=netHLn9TScY', true),
            array(array('youtube', 'vimeo'), 'https://youtu.be/netHLn9TScY', true),
            array(array('youtube', 'vimeo'), 'https://www.youtube.com/embed/netHLn9TScY', true),
            array(array('youtube', 'vimeo'), 'https://vimeo.com/71787467', true),
            array(array('youtube', 'vimeo'), 'https://player.vimeo.com/video/71787467', true),
            array(null, 'https://www.youtube.com/watch?v=netHLn9TScY', true),
            array(null, 'https://youtu.be/netHLn9TScY', true),
            array(null, 'https://www.youtube.com/embed/netHLn9TScY', true),
            array(null, 'https://vimeo.com/71787467', true),
            array(null, 'https://player.vimeo.com/video/71787467', true),

            // Invalid data
            array(null, 'https://www.google.com', false),
            array(null, 'example.com', false),
            array(null, 'http:/example.com/', false),
            array(null, 'tel:+1-816-555-1212', false),
            array(null, 'text', false),
        );
    }

    /**
     * @dataProvider validVideoUrlProvider
     */
    public function testShouldValidateVideoUrl($provider, $input, $expected)
    {
        $rule = new VideoUrl($provider);

        $this->assertEquals($expected, $rule->validate($input));
    }
}
