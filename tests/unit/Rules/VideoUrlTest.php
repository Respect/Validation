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
     * @expectedExceptionMessage "teste" is not a recognized video URL provider.
     */
    public function testShouldThrowsAnExceptionWhenProviderIsNotValid()
    {
        new VideoUrl('teste');
    }

    public function validVideoUrlProvider()
    {
        return array(
            array('vimeo', 'https://player.vimeo.com/video/71787467'),
            array('vimeo', 'https://vimeo.com/71787467'),
            array('youtube', 'https://www.youtube.com/embed/netHLn9TScY'),
            array('youtube', 'https://www.youtube.com/watch?v=netHLn9TScY'),
            array('youtube', 'https://youtu.be/netHLn9TScY'),
            array(null, 'https://player.vimeo.com/video/71787467'),
            array(null, 'https://vimeo.com/71787467'),
            array(null, 'https://www.youtube.com/embed/netHLn9TScY'),
            array(null, 'https://www.youtube.com/watch?v=netHLn9TScY'),
            array(null, 'https://youtu.be/netHLn9TScY'),
        );
    }

    public function invalidVideoUrlProvider()
    {
        return array(
            array('vimeo', 'https://www.youtube.com/watch?v=netHLn9TScY'),
            array('youtube', 'https://vimeo.com/71787467'),
            array(null, 'example.com'),
            array(null, 'ftp://youtu.be/netHLn9TScY'),
            array(null, 'https:/example.com/'),
            array(null, 'https:/youtube.com/'),
            array(null, 'https://vimeo'),
            array(null, 'https://vimeo.com71787467'),
            array(null, 'https://www.google.com'),
            array(null, 'tel:+1-816-555-1212'),
            array(null, 'text'),
        );
    }

    /**
     * @dataProvider validVideoUrlProvider
     */
    public function testShouldValidateVideoUrl($provider, $input)
    {
        $rule = new VideoUrl($provider);

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider invalidVideoUrlProvider
     */
    public function testShouldInvalidateNonVideoUrl($provider, $input)
    {
        $rule = new VideoUrl($provider);

        $this->assertFalse($rule->validate($input));
    }
}
