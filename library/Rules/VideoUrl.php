<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function array_keys;
use function is_string;
use function mb_strtolower;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid video URL',
    '{{subject}} must not be a valid video URL',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must be a valid {{service|raw}} video URL',
    '{{subject}} must not be a valid {{service|raw}} video URL',
    self::TEMPLATE_SERVICE,
)]
final class VideoUrl implements Rule
{
    public const string TEMPLATE_SERVICE = '__service__';

    private const array SERVICES = [
        // phpcs:disable Generic.Files.LineLength.TooLong
        'youtube' => '@^https?://(www\.)?(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^\"&?/]{11})@i',
        'vimeo' => '@^https?://(www\.)?(player\.)?(vimeo\.com/)((channels/[A-z]+/)|(groups/[A-z]+/videos/)|(video/))?([0-9]+)@i',
        'twitch' => '@^https?://(((www\.)?twitch\.tv/videos/[0-9]+)|clips\.twitch\.tv/[a-zA-Z]+)$@i',
        // phpcs:enable Generic.Files.LineLength.TooLong
    ];

    public function __construct(
        private readonly string|null $service = null,
    ) {
        if ($service !== null && !$this->isSupportedService($service)) {
            throw new InvalidRuleConstructorException('"%s" is not a recognized video service.', $service);
        }
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['service' => $this->service];
        $template = $this->service !== null ? self::TEMPLATE_SERVICE : self::TEMPLATE_STANDARD;
        if (!is_string($input)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        if ($this->service !== null) {
            return Result::of($this->isValid($this->service, $input), $input, $this, $parameters, $template);
        }

        foreach (array_keys(self::SERVICES) as $service) {
            if (!$this->isValid($service, $input)) {
                continue;
            }

            return Result::passed($input, $this, $parameters, $template);
        }

        return Result::failed($input, $this, $parameters, $template);
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
