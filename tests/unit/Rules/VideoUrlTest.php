<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\VideoUrl
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ricardo Gobbo <ricardo@clicknow.com.br>
 */
final class VideoUrlTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            'vimeo service with subdomain' => [new VideoUrl('vimeo'), 'https://player.vimeo.com/video/71787467'],
            'vimeo service url' => [new VideoUrl('vimeo'), 'https://vimeo.com/71787467'],
            'youtube service embed' => [new VideoUrl('youtube'), 'https://www.youtube.com/embed/netHLn9TScY'],
            'youtube service url' => [new VideoUrl('youtube'), 'https://www.youtube.com/watch?v=netHLn9TScY'],
            'youtube service short url' => [new VideoUrl('youtube'), 'https://youtu.be/netHLn9TScY'],
            'no service, vimeo with subdomain' => [new VideoUrl(), 'https://player.vimeo.com/video/71787467'],
            'no service, vimeo url' => [new VideoUrl(), 'https://vimeo.com/71787467'],
            'no service, youtube embed' => [new VideoUrl(), 'https://www.youtube.com/embed/netHLn9TScY'],
            'no service, youtube url' => [new VideoUrl(), 'https://www.youtube.com/watch?v=netHLn9TScY'],
            'no service, youtube short url' => [new VideoUrl(), 'https://youtu.be/netHLn9TScY'],
            'twitch video' => [new VideoUrl('twitch'), 'https://www.twitch.tv/videos/320689092'],
            'twitch clip' => [new VideoUrl('twitch'), 'https://clips.twitch.tv/BitterLazyMangetoutHumbleLife'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            'vimeo service with youtube url' => [new VideoUrl('vimeo'), 'https://www.youtube.com/watch?v=netHLn9TScY'],
            'youtube service with vimeo url' => [new VideoUrl('youtube'), 'https://vimeo.com/71787467'],
            'no service with example.com url' => [new VideoUrl(), 'example.com'],
            'no service with ftp://youtu.be/netHLn9TScY url' => [new VideoUrl(), 'ftp://youtu.be/netHLn9TScY'],
            'no service with https:/example.com/ url' => [new VideoUrl(), 'https:/example.com/'],
            'no service with https:/youtube.com/ url' => [new VideoUrl(), 'https:/youtube.com/'],
            'no service with https://vimeo' => [new VideoUrl(), 'https://vimeo'],
            'no service with https://vimeo.com71787467' => [new VideoUrl(), 'https://vimeo.com71787467'],
            'no service with https://www.google.com url ' => [new VideoUrl(), 'https://www.google.com'],
            'no service and value tel:+1-816-555-1212' => [new VideoUrl(), 'tel:+1-816-555-1212'],
            'no service and value text' => [new VideoUrl(), 'text'],
            'invalid twitch link without video identifier' => [new VideoUrl(), 'https://twitch.tv/'],
            'invalid twitch clip' => [new VideoUrl(), 'https://www.twitch.tv/yabbadabbado'],
            'invalid twitch link' => [new VideoUrl(), 'https://clips.twitch.tv/videos/90210'],
            'invalid twitch clip identifier' => [new VideoUrl(), 'https://clips.twitch.tv/90210'],
            'twitch clip without identifier' => [new VideoUrl(), 'https://clips.twitch.tv/'],
        ];
    }
}
