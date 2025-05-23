<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function is_string;

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

    public function __construct(
        private readonly ?int $version = null
    ) {
        if ($version !== null && !$this->isSupportedVersion($version)) {
            throw new InvalidRuleConstructorException(
                'Only versions 1 to 8 are supported: %d given',
                (string)$version
            );
        }
    }

    public function evaluate(mixed $input): Result
    {
        $template   = $this->version ? self::TEMPLATE_VERSION : self::TEMPLATE_STANDARD;
        $parameters = ['version' => $this->version];

        if (!is_string($input) && !($input instanceof UuidInterface)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        if (is_string($input) && RamseyUuid::isValid($input)) {
            $uuid = RamseyUuid::fromString($input);
        } elseif ($input instanceof UuidInterface) {
            $uuid = $input;
        } else {
            return Result::failed($input, $this, $parameters, $template);
        }

        /** @phpstan-ignore-next-line */
        $uuidVersion = $uuid->getFields()->getVersion();
        $hasPassed   = $this->version ? $uuidVersion === $this->version : $uuidVersion !== null;

        return new Result($hasPassed, $input, $this, $parameters, $template);
    }

    private function isSupportedVersion(int $version): bool
    {
        return $version >= 1 && $version <= 8;
    }
}
