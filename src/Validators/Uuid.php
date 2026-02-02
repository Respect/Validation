<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Andre Ramaciotti <andre@ramaciotti.com>
 * SPDX-FileContributor: Dick van der Heiden <d.vanderheiden@inthere.nl>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Kleber Hamada Sato <kleberhs007@yahoo.com>
 * SPDX-FileContributor: Michael Weimann <mail@michael-weimann.eu>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: steven.lewis <stevenlewis@gowebprint.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Ramsey\Uuid\Rfc4122\FieldsInterface;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidInterface;
use Respect\Validation\ContainerRegistry;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Throwable;

use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a UUID',
    '{{subject}} must not be a UUID',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must be a UUID v{{version|raw}}',
    '{{subject}} must not be a UUID v{{version|raw}}',
    self::TEMPLATE_VERSION,
)]
final class Uuid implements Validator
{
    public const string TEMPLATE_VERSION = '__version__';

    public function __construct(
        private readonly int|null $version = null,
    ) {
        if (!ContainerRegistry::getContainer()->has(UuidFactory::class)) {
            throw new MissingComposerDependencyException(
                'Uuid rule requires ramsey/uuid package',
                'ramsey/uuid',
            );
        }

        if ($version !== null && !$this->isSupportedVersion($version)) {
            throw new InvalidValidatorException(
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
            $uuid = is_string($input) ? ContainerRegistry::getContainer()
                ->get(UuidFactory::class)
                ->fromString($input) : $input;
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
