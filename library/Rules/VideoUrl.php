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

use Respect\Validation\Exceptions\ComponentException;
use function mb_strtolower;
use function preg_match;
use function sprintf;

/**
 * Validates if the input is a video URL value:
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ricardo Gobbo <ricardo@clicknow.com.br>
 */
final class VideoUrl extends AbstractRule
{
    /**
     * @var string
     */
    public $service;

    /**
     * @var string
     */
    private $serviceKey;

    /**
     * @var array
     */
    private $services = [
        'youtube' => '@^https?://(www\.)?(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^\"&?/]{11})@i',
        'vimeo' => '@^https?://(www\.)?(player\.)?(vimeo\.com/)((channels/[A-z]+/)|(groups/[A-z]+/videos/)|(video/))?([0-9]+)@i',
        'twitch' => '@^https?://(((www\.)?twitch\.tv/videos/[0-9]+)|clips\.twitch\.tv/[a-zA-Z]+)$@i',
    ];

    /**
     * Create a new instance VideoUrl.
     *
     * @param string $service
     */
    public function __construct(string $service = null)
    {
        $serviceKey = mb_strtolower((string) $service);
        if (null !== $service && !isset($this->services[$serviceKey])) {
            throw new ComponentException(sprintf('"%s" is not a recognized video service.', $service));
        }

        $this->service = $service;
        $this->serviceKey = $serviceKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (isset($this->services[$this->serviceKey])) {
            return preg_match($this->services[$this->serviceKey], (string) $input) > 0;
        }

        foreach ($this->services as $pattern) {
            if (0 === preg_match($pattern, (string) $input)) {
                continue;
            }

            return true;
        }

        return false;
    }
}
