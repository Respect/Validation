<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

final class PrefixConstants
{
    public const array COMPOSABLE = [
        'propertyOptional' => true,
        'propertyExists' => true,
        'keyOptional' => true,
        'keyExists' => true,
        'property' => true,
        'undefOr' => true,
        'keySet' => true,
        'length' => true,
        'nullOr' => true,
        'allOf' => true,
        'all' => true,
        'key' => true,
        'max' => true,
        'min' => true,
        'not' => true,
    ];
    public const array COMPOSABLE_WITH_ARGUMENT = ['key' => true, 'property' => true];
    public const array FORBIDDEN = [
        'All' => ['all' => true],
        'Attributes' => ['all' => true, 'key' => true, 'not' => true, 'property' => true, 'undefOr' => true],
        'Blank' => ['nullOr' => true, 'undefOr' => true],
        'Exists' => ['all' => true, 'key' => true, 'property' => true],
        'Formatted' => ['all' => true, 'key' => true, 'property' => true],
        'Key' => ['all' => true, 'key' => true, 'property' => true],
        'KeyExists' => ['all' => true, 'key' => true, 'property' => true],
        'KeyOptional' => ['all' => true, 'key' => true, 'property' => true],
        'KeySet' => ['all' => true, 'key' => true, 'property' => true],
        'Length' => ['all' => true, 'key' => true, 'length' => true, 'max' => true, 'min' => true, 'not' => true, 'nullOr' => true, 'property' => true, 'undefOr' => true],
        'Max' => ['all' => true, 'key' => true, 'length' => true, 'max' => true, 'min' => true, 'not' => true, 'nullOr' => true, 'property' => true, 'undefOr' => true],
        'Min' => ['all' => true, 'key' => true, 'length' => true, 'max' => true, 'min' => true, 'not' => true, 'nullOr' => true, 'property' => true, 'undefOr' => true],
        'Named' => ['all' => true, 'key' => true, 'not' => true, 'nullOr' => true, 'property' => true, 'undefOr' => true],
        'Not' => ['not' => true],
        'NullOr' => ['all' => true, 'key' => true, 'not' => true, 'nullOr' => true, 'property' => true, 'undefOr' => true],
        'Property' => ['all' => true, 'key' => true, 'property' => true],
        'PropertyExists' => ['all' => true, 'key' => true, 'property' => true],
        'PropertyOptional' => ['all' => true, 'key' => true, 'property' => true],
        'Templated' => ['all' => true, 'key' => true, 'not' => true, 'nullOr' => true, 'property' => true, 'undefOr' => true],
        'Undef' => ['nullOr' => true, 'undefOr' => true],
        'UndefOr' => ['all' => true, 'key' => true, 'not' => true, 'nullOr' => true, 'property' => true, 'undefOr' => true],
    ];
}
