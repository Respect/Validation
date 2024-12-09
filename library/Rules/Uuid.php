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
use Respect\Validation\Rules\Core\Standard;

use function is_string;
use function preg_match;
use function sprintf;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid UUID',
    '{{name}} must not be a valid UUID',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be a valid UUID version {{version|raw}}',
    '{{name}} must not be a valid UUID version {{version|raw}}',
    self::TEMPLATE_VERSION,
)]
final class Uuid extends Standard
{
    public const TEMPLATE_VERSION = '__version__';

    private const PATTERN_FORMAT = '/^[0-9a-f]{8}-[0-9a-f]{4}-%s[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    public function __construct(
        private readonly ?int $version = null
    ) {
        if ($version !== null && !$this->isSupportedVersion($version)) {
            throw new InvalidRuleConstructorException(
                'Only versions 1, 3, 4, and 5 are supported: %d given',
                (string) $version
            );
        }
    }

    public function evaluate(mixed $input): Result
    {
        $template = $this->version ? self::TEMPLATE_VERSION : self::TEMPLATE_STANDARD;
        $parameters = ['version' => $this->version];
        if (!is_string($input)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        return new Result(preg_match($this->getPattern(), $input) > 0, $input, $this, $parameters, $template);
    }

    private function isSupportedVersion(int $version): bool
    {
        return $version >= 1 && $version <= 5 && $version !== 2;
    }

    private function getPattern(): string
    {
        if ($this->version !== null) {
            return sprintf(self::PATTERN_FORMAT, $this->version);
        }

        return sprintf(self::PATTERN_FORMAT, '[13-5]');
    }
}
