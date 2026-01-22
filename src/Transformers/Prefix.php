<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use function array_shift;
use function in_array;
use function str_starts_with;
use function strlen;
use function substr;

final class Prefix implements Transformer
{
    private const array RULES_TO_SKIP = [
        'all',
        'allOf',
        'key',
        'keyExists',
        'keyOptional',
        'keySet',
        'length',
        'max',
        'maxAge',
        'min',
        'minAge',
        'not',
        'emoji',
        'nullOr',
        'property',
        'propertyExists',
        'propertyOptional',
        'undefOr',
    ];

    public function transform(ValidatorSpec $validatorSpec): ValidatorSpec
    {
        if ($validatorSpec->wrapper !== null || in_array($validatorSpec->name, self::RULES_TO_SKIP, true)) {
            return $validatorSpec;
        }

        foreach (['all', 'length', 'max', 'min', 'not', 'nullOr', 'undefOr'] as $prefix) {
            if (!str_starts_with($validatorSpec->name, $prefix)) {
                continue;
            }

            return new ValidatorSpec(
                substr($validatorSpec->name, strlen($prefix)),
                $validatorSpec->arguments,
                new ValidatorSpec($prefix),
            );
        }

        foreach (['key', 'property'] as $prefix) {
            if (!str_starts_with($validatorSpec->name, $prefix)) {
                continue;
            }

            $arguments = $validatorSpec->arguments;
            array_shift($arguments);
            $wrapperArguments = [$validatorSpec->arguments[0]];

            return new ValidatorSpec(
                substr($validatorSpec->name, strlen($prefix)),
                $arguments,
                new ValidatorSpec($prefix, $wrapperArguments),
            );
        }

        return $validatorSpec;
    }
}
