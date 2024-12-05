<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use Respect\Validation\Rule;
use Respect\Validation\Rules\ArrayVal;
use Respect\Validation\Rules\Key;
use Respect\Validation\Rules\KeyExists;
use Respect\Validation\Rules\KeyOptional;
use Respect\Validation\Rules\Property;
use Respect\Validation\Rules\PropertyExists;
use Respect\Validation\Rules\PropertyOptional;
use Respect\Validation\Rules\When;

use function array_pop;
use function array_reduce;
use function array_reverse;
use function explode;
use function trigger_error;
use function trim;

use const E_USER_DEPRECATED;

final class DeprecatedKeyNested implements Transformer
{
    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if ($ruleSpec->name !== 'keyNested') {
            return $this->next->transform($ruleSpec);
        }

        trigger_error(
            'The keyNested() rule is deprecated and will be removed in the next major version. ' .
            'Use nested key() or property() instead.',
            E_USER_DEPRECATED
        );

        $key = $ruleSpec->arguments[0] ?? '';
        $rule = $ruleSpec->arguments[1] ?? null;
        $mandatory = $ruleSpec->arguments[2] ?? true;
        $pieces = array_reverse(explode('.', trim($key, '.')));
        $firstKey = array_pop($pieces);
        $arrayVal = new ArrayVal();
        $firstRule = array_reduce(
            $pieces,
            fn (?Rule $rule, string $piece) => new When(
                $arrayVal,
                $this->createKeyRule($piece, $mandatory, $rule),
                $this->createPropertyRule($piece, $mandatory, $rule),
            ),
            $rule,
        );

        return new RuleSpec(
            'when',
            [
                $arrayVal,
                $this->createKeyRule($firstKey, $mandatory, $firstRule),
                $this->createPropertyRule($firstKey, $mandatory, $firstRule),
            ]
        );
    }

    private function createPropertyRule(string $name, bool $mandatory, ?Rule $rule): Rule
    {
        if ($rule === null) {
            return new PropertyExists($name);
        }

        if ($mandatory) {
            return new Property($name, $rule);
        }

        return new PropertyOptional($name, $rule);
    }

    private function createKeyRule(string $key, bool $mandatory, ?Rule $rule): Rule
    {
        if ($rule === null) {
            return new KeyExists($key);
        }

        if ($mandatory) {
            return new Key($key, $rule);
        }

        return new KeyOptional($key, $rule);
    }
}
