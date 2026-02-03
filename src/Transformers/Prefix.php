<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use function array_keys;
use function array_slice;
use function implode;
use function preg_match;
use function sprintf;

final class Prefix implements Transformer
{
    private const array RULES_THAT_PREFIX_OR_STAND_ALONE = [
        'all' => true,
        'allOf' => true,
        'emoji' => true,
        'key' => true,
        'keyExists' => true,
        'keyOptional' => true,
        'keySet' => true,
        'length' => true,
        'max' => true,
        'maxAge' => true,
        'min' => true,
        'minAge' => true,
        'not' => true,
        'nullOr' => true,
        'property' => true,
        'propertyExists' => true,
        'propertyOptional' => true,
        'undefOr' => true,
    ];
    private const array RULES_THAT_USE_SUFFIX_AS_ARGUMENT = [
        'key' => true,
        'property' => true,
    ];

    private static string|null $regex = null;

    public function transform(ValidatorSpec $validatorSpec): ValidatorSpec
    {
        $matches = $this->match($validatorSpec);
        if ($matches === []) {
            return $validatorSpec;
        }

        if (!isset(self::RULES_THAT_USE_SUFFIX_AS_ARGUMENT[$matches['name']])) {
            return new ValidatorSpec(
                $matches['rest'],
                $validatorSpec->arguments,
                new ValidatorSpec($matches['name']),
            );
        }

        return new ValidatorSpec(
            $matches['rest'],
            array_slice($validatorSpec->arguments, 1),
            new ValidatorSpec($matches['name'], [$validatorSpec->arguments[0]]),
        );
    }

    /** @return array{}|array{name: string, rest: string} */
    private function match(ValidatorSpec $validatorSpec): array
    {
        if ($validatorSpec->wrapper !== null || isset(self::RULES_THAT_PREFIX_OR_STAND_ALONE[$validatorSpec->name])) {
            return [];
        }

        preg_match(self::getRegex(), $validatorSpec->name, $matches);

        return $matches;
    }

    private static function getRegex(): string
    {
        return self::$regex ?? self::$regex = sprintf(
            '/^(?<name>%s)(?<rest>.+)$/',
            implode('|', array_keys(self::RULES_THAT_PREFIX_OR_STAND_ALONE)),
        );
    }
}
