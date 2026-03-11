<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

final class PrefixMap
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
}
