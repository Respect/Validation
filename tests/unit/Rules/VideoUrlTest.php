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
 * @covers \Respect\Validation\Rules\VideoUrl
 * @covers \Respect\Validation\Exceptions\VideoUrlException
 */
class VideoUrlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "teste" is not a recognized video service.
     */
    public function testShouldThrowsAnExceptionWhenProviderIsNotValid()
    {
        new VideoUrl('teste');
    }

    public function validVideoUrlProvider()
    {
        return [
            ['vimeo', 'https://player.vimeo.com/video/71787467'],
            ['vimeo', 'https://vimeo.com/71787467'],
            ['youtube', 'https://www.youtube.com/embed/netHLn9TScY'],
            ['youtube', 'https://www.youtube.com/watch?v=netHLn9TScY'],
            ['youtube', 'https://youtu.be/netHLn9TScY'],
            [null, 'https://player.vimeo.com/video/71787467'],
            [null, 'https://vimeo.com/71787467'],
            [null, 'https://www.youtube.com/embed/netHLn9TScY'],
            [null, 'https://www.youtube.com/watch?v=netHLn9TScY'],
            [null, 'https://youtu.be/netHLn9TScY'],
        ];
    }

    public function invalidVideoUrlProvider()
    {
        return [
            ['vimeo', 'https://www.youtube.com/watch?v=netHLn9TScY'],
            ['youtube', 'https://vimeo.com/71787467'],
            [null, 'example.com'],
            [null, 'ftp://youtu.be/netHLn9TScY'],
            [null, 'https:/example.com/'],
            [null, 'https:/youtube.com/'],
            [null, 'https://vimeo'],
            [null, 'https://vimeo.com71787467'],
            [null, 'https://www.google.com'],
            [null, 'tel:+1-816-555-1212'],
            [null, 'text'],
        ];
    }

    /**
     * @dataProvider validVideoUrlProvider
     */
    public function testShouldValidateVideoUrl($service, $input)
    {
        $rule = new VideoUrl($service);

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider invalidVideoUrlProvider
     */
    public function testShouldInvalidateNonVideoUrl($service, $input)
    {
        $rule = new VideoUrl($service);

        $this->assertFalse($rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\VideoUrlException
     * @expectedExceptionMessage "exemplo.com" must be a valid video URL
     */
    public function testUseAProperExceptionMessageWhenVideoUrlIsNotValid()
    {
        $rule = new VideoUrl();
        $rule->check('exemplo.com');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\VideoUrlException
     * @expectedExceptionMessage "exemplo.com" must be a valid "YouTube" video URL
     */
    public function testUseAProperExceptionMessageWhenVideoUrlIsNotValidForTheDefinedProvider()
    {
        $rule = new VideoUrl('YouTube');
        $rule->check('exemplo.com');
    }
}
