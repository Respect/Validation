<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\Template;

use function array_keys;
use function is_string;
use function mb_strtolower;
use function preg_match;
use function sprintf;

#[Template(
    '{{name}} must be a valid video URL',
    '{{name}} must not be a valid video URL',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be a valid {{service|raw}} video URL',
    '{{name}} must not be a valid {{service|raw}} video URL',
    self::TEMPLATE_SERVICE,
)]
final class VideoUrl extends AbstractRule
{
    public const TEMPLATE_SERVICE = '__service__';

    private const SERVICES = [
        // phpcs:disable Generic.Files.LineLength.TooLong
        'youtube' => '@^https?://(www\.)?(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^\"&?/]{11})@i',
        'vimeo' => '@^https?://(www\.)?(player\.)?(vimeo\.com/)((channels/[A-z]+/)|(groups/[A-z]+/videos/)|(video/))?([0-9]+)@i',
        'twitch' => '@^https?://(((www\.)?twitch\.tv/videos/[0-9]+)|clips\.twitch\.tv/[a-zA-Z]+)$@i',
        // phpcs:enable Generic.Files.LineLength.TooLong
    ];

    public function __construct(
        private readonly ?string $service = null
    ) {
        if ($service !== null && !$this->isSupportedService($service)) {
            throw new ComponentException(sprintf('"%s" is not a recognized video service.', $service));
        }
    }

    public function validate(mixed $input): bool
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

    /**
     * @return array<string, string|null>
     */
    public function getParams(): array
    {
        return ['service' => $this->service];
    }

    protected function getStandardTemplate(mixed $input): string
    {
        return $this->service ? self::TEMPLATE_SERVICE : self::TEMPLATE_STANDARD;
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
