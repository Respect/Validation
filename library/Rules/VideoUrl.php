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

use Respect\Validation\Exceptions\ComponentException;

use function array_keys;
use function is_string;
use function mb_strtolower;
use function preg_match;
use function sprintf;

/**
 * Validates if the input is a video URL value.
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ricardo Gobbo <ricardo@clicknow.com.br>
 */
final class VideoUrl extends AbstractRule
{
    private const SERVICES = [
        // phpcs:disable Generic.Files.LineLength.TooLong
        'youtube' => '@^https?://(www\.)?(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^\"&?/]{11})@i',
        'vimeo' => '@^https?://(www\.)?(player\.)?(vimeo\.com/)((channels/[A-z]+/)|(groups/[A-z]+/videos/)|(video/))?([0-9]+)@i',
        'twitch' => '@^https?://(((www\.)?twitch\.tv/videos/[0-9]+)|clips\.twitch\.tv/[a-zA-Z]+)$@i',
        // phpcs:enable Generic.Files.LineLength.TooLong
    ];

    /**
     * @var string|null
     */
    private $service;

    /**
     * Create a new instance VideoUrl.
     *
     * @throws ComponentException when the given service is not supported
     */
    public function __construct(?string $service = null)
    {
        if ($service !== null && !$this->isSupportedService($service)) {
            throw new ComponentException(sprintf('"%s" is not a recognized video service.', $service));
        }

        $this->service = $service;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if ($this->service !== null) {
            return $this->isValid($this->service, $input);
        }

        foreach (array_keys(self::SERVICES) as $service) {
            if (!$this->isValid($service, $input)) {
                continue;
            }

            return true;
        }

        return false;
    }

    private function isSupportedService(string $service): bool
    {
        return isset(self::SERVICES[mb_strtolower($service)]);
    }

    private function isValid(string $service, string $input): bool
    {
        return preg_match(self::SERVICES[mb_strtolower($service)], $input) > 0;
    }
}
