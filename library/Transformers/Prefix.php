<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use function array_shift;
use function in_array;
use function str_starts_with;
use function substr;

final class Prefix implements Transformer
{
    private const RULES_TO_SKIP = [
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
        'notBlank',
        'notEmoji',
        'notEmpty',
        'notOptional',
        'nullOr',
        'property',
        'propertyExists',
        'propertyOptional',
        'undefOr',
    ];

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if ($ruleSpec->wrapper !== null || in_array($ruleSpec->name, self::RULES_TO_SKIP, true)) {
            return $ruleSpec;
        }

        if (str_starts_with($ruleSpec->name, 'key')) {
            $arguments = $ruleSpec->arguments;
            array_shift($arguments);
            $wrapperArguments = [$ruleSpec->arguments[0]];

            return new RuleSpec(substr($ruleSpec->name, 3), $arguments, new RuleSpec('key', $wrapperArguments));
        }

        if (str_starts_with($ruleSpec->name, 'length')) {
            return new RuleSpec(substr($ruleSpec->name, 6), $ruleSpec->arguments, new RuleSpec('length'));
        }

        if (str_starts_with($ruleSpec->name, 'max')) {
            return new RuleSpec(substr($ruleSpec->name, 3), $ruleSpec->arguments, new RuleSpec('max'));
        }

        if (str_starts_with($ruleSpec->name, 'min')) {
            return new RuleSpec(substr($ruleSpec->name, 3), $ruleSpec->arguments, new RuleSpec('min'));
        }

        if (str_starts_with($ruleSpec->name, 'not')) {
            return new RuleSpec(substr($ruleSpec->name, 3), $ruleSpec->arguments, new RuleSpec('not'));
        }

        if (str_starts_with($ruleSpec->name, 'nullOr')) {
            return new RuleSpec(substr($ruleSpec->name, 6), $ruleSpec->arguments, new RuleSpec('nullOr'));
        }

        if (str_starts_with($ruleSpec->name, 'property')) {
            $arguments = $ruleSpec->arguments;
            array_shift($arguments);
            $wrapperArguments = [$ruleSpec->arguments[0]];

            return new RuleSpec(substr($ruleSpec->name, 8), $arguments, new RuleSpec('property', $wrapperArguments));
        }

        if (str_starts_with($ruleSpec->name, 'undefOr')) {
            return new RuleSpec(substr($ruleSpec->name, 7), $ruleSpec->arguments, new RuleSpec('undefOr'));
        }

        return $ruleSpec;
    }
}
