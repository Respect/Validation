<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Ramsey\Uuid\Rfc4122\FieldsInterface;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Throwable;

use function class_exists;
use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid UUID',
    '{{subject}} must not be a valid UUID',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must be a valid UUID version {{version|raw}}',
    '{{subject}} must not be a valid UUID version {{version|raw}}',
    self::TEMPLATE_VERSION,
)]
final class Uuid implements Rule
{
    public const string TEMPLATE_VERSION = '__version__';

    public function __construct(
        private readonly int|null $version = null,
    ) {
        if (!class_exists(RamseyUuid::class)) {
            throw new MissingComposerDependencyException('Uuid rule requires ramsey/uuid', '=');
        }

        if ($version !== null && !$this->isSupportedVersion($version)) {
            throw new InvalidRuleConstructorException(
                'Only versions 1 to 8 are supported: %d given',
                (string) $version,
            );
        }
    }

    public function evaluate(mixed $input): Result
    {
        $template = $this->version ? self::TEMPLATE_VERSION : self::TEMPLATE_STANDARD;
        $parameters = ['version' => $this->version];

        if (!is_string($input) && !($input instanceof UuidInterface)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        try {
            $uuid = is_string($input) ? RamseyUuid::fromString($input) : $input;
        } catch (Throwable) {
            return Result::failed($input, $this, $parameters, $template);
        }

        $fields = $uuid->getFields();
        $uuidVersion = $fields instanceof FieldsInterface ? $fields->getVersion() : null;

        $hasPassed = $this->version ? $uuidVersion === $this->version : $uuidVersion !== null;

        return Result::of($hasPassed, $input, $this, $parameters, $template);
    }

    private function isSupportedVersion(int $version): bool
    {
        return $version >= 1 && $version <= 8;
    }
}
