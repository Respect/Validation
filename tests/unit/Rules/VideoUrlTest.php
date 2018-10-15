<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\VideoUrlException
 * @covers \Respect\Validation\Rules\VideoUrl
 */
class VideoUrlTest extends TestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "teste" is not a recognized video service.
     *
     * @test
     */
    public function shouldThrowsAnExceptionWhenProviderIsNotValid(): void
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
            ['twitch', 'https://www.twitch.tv/videos/320689092'],
            ['twitch', 'https://clips.twitch.tv/BitterLazyMangetoutHumbleLife'],
            [null, 'https://player.vimeo.com/video/71787467'],
            [null, 'https://vimeo.com/71787467'],
            [null, 'https://www.youtube.com/embed/netHLn9TScY'],
            [null, 'https://www.youtube.com/watch?v=netHLn9TScY'],
            [null, 'https://youtu.be/netHLn9TScY'],
            [null, 'https://www.twitch.tv/videos/320689092'],
            [null, 'https://clips.twitch.tv/BitterLazyMangetoutHumbleLife'],
        ];
    }

    public function invalidVideoUrlProvider()
    {
        return [
            ['vimeo', 'https://www.youtube.com/watch?v=netHLn9TScY'],
            ['youtube', 'https://vimeo.com/71787467'],
            ['twitch', 'https://www.twitch.tv/BitterLazyMangetoutHumbleLife'],
            ['twitch', 'https://clips.twitch.tv/videos/320689092'],
            ['twitch', 'https://clips.twitch.tv/320689092'],
            [null, 'example.com'],
            [null, 'ftp://youtu.be/netHLn9TScY'],
            [null, 'https:/example.com/'],
            [null, 'https:/youtube.com/'],
            [null, 'https://vimeo'],
            [null, 'https://vimeo.com71787467'],
            [null, 'https://www.google.com'],
            [null, 'tel:+1-816-555-1212'],
            [null, 'text'],
            [null, 'https://twitch.tv/'],
            [null, 'https://www.twitch.tv/yabbadabbado'],
            [null, 'https://clips.twitch.tv/videos/90210'],
            [null, 'https://clips.twitch.tv/90210'],
            [null, 'https://clips.twitch.tv/'],
        ];
    }

    /**
     * @dataProvider validVideoUrlProvider
     *
     * @test
     */
    public function shouldValidateVideoUrl($service, $input): void
    {
        $rule = new VideoUrl($service);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider invalidVideoUrlProvider
     *
     * @test
     */
    public function shouldInvalidateNonVideoUrl($service, $input): void
    {
        $rule = new VideoUrl($service);

        self::assertFalse($rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\VideoUrlException
     * @expectedExceptionMessage "exemplo.com" must be a valid video URL
     *
     * @test
     */
    public function useAProperExceptionMessageWhenVideoUrlIsNotValid(): void
    {
        $rule = new VideoUrl();
        $rule->check('exemplo.com');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\VideoUrlException
     * @expectedExceptionMessage "exemplo.com" must be a valid "YouTube" video URL
     *
     * @test
     */
    public function useAProperExceptionMessageWhenVideoUrlIsNotValidForTheDefinedProvider(): void
    {
        $rule = new VideoUrl('YouTube');
        $rule->check('exemplo.com');
    }
}
