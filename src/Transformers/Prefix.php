<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use Respect\Validation\Mixins\PrefixMap;

use function array_keys;
use function array_slice;
use function implode;
use function preg_match;
use function sprintf;

final class Prefix implements Transformer
{
    private static string|null $regex = null;

    public function transform(ValidatorSpec $validatorSpec): ValidatorSpec
    {
        $matches = $this->match($validatorSpec);
        if ($matches === []) {
            return $validatorSpec;
        }

        if (!isset(PrefixMap::COMPOSABLE_WITH_ARGUMENT[$matches['prefix']])) {
            return new ValidatorSpec(
                $matches['suffix'],
                $validatorSpec->arguments,
                new ValidatorSpec($matches['prefix']),
            );
        }

        return new ValidatorSpec(
            $matches['suffix'],
            array_slice($validatorSpec->arguments, 1),
            new ValidatorSpec($matches['prefix'], [$validatorSpec->arguments[0]]),
        );
    }

    /** @return array{}|array{prefix: string, suffix: string} */
    private function match(ValidatorSpec $validatorSpec): array
    {
        if ($validatorSpec->wrapper !== null || isset(PrefixMap::COMPOSABLE[$validatorSpec->name])) {
            return [];
        }

        preg_match(self::getRegex(), $validatorSpec->name, $matches);

        if ($matches === []) {
            return [];
        }

        return ['prefix' => $matches['prefix'], 'suffix' => $matches['suffix']];
    }

    private static function getRegex(): string
    {
        return self::$regex ?? self::$regex = sprintf(
            '/^(?<prefix>%s)(?<suffix>.+)$/',
            implode('|', array_keys(PrefixMap::COMPOSABLE)),
        );
    }
}
