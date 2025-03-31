<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\KeyRelated;
use Respect\Validation\Rules\Core\Reducer;
use Respect\Validation\Rules\Core\Standard;
use Respect\Validation\Validator;

use function array_diff;
use function array_filter;
use function array_keys;
use function array_map;
use function array_merge;
use function array_slice;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} validation failed',
    '{{name}} validation passed',
)]
#[Template(
    '{{name}} contains both missing and extra keys',
    '{{name}} contains no missing or extra keys.',
    self::TEMPLATE_BOTH
)]
#[Template(
    '{{name}} contains extra keys',
    '{{name}} contains no extra keys',
    self::TEMPLATE_EXTRA_KEYS
)]
#[Template(
    '{{name}} contains missing keys',
    '{{name}} contains no missing keys',
    self::TEMPLATE_MISSING_KEYS
)]
final class KeySet extends Standard
{
    public const TEMPLATE_BOTH = '__both__';
    public const TEMPLATE_EXTRA_KEYS = '__extra_keys__';
    public const TEMPLATE_MISSING_KEYS = '__missing_keys__';

    private const MAX_DIFF_KEYS = 10;

    /** @var array<KeyRelated> */
    private readonly array $rules;

    /** @var array<int|string> */
    private readonly array $allKeys;

    /** @var array<int|string> */
    private readonly array $mandatoryKeys;

    public function __construct(Rule $rule, Rule ...$rules)
    {
        $this->rules = $this->extractKeyRelatedRules(array_merge([$rule], $rules));
        $this->allKeys = array_map(static fn(KeyRelated $rule) => $rule->getKey(), $this->rules);
        $this->mandatoryKeys = array_map(
            static fn(KeyRelated $rule) => $rule->getKey(),
            array_filter($this->rules, static fn(KeyRelated $rule) => !$rule instanceof KeyOptional),
        );
    }

    public function evaluate(mixed $input): Result
    {
        $arrayResult = (new ArrayType())->evaluate($input);
        if (!$arrayResult->hasPassed) {
            return $arrayResult;
        }

        $keys = new Reducer(...array_merge($this->rules, array_map(
            static fn(string|int $key) => new Not(new KeyExists($key)),
            array_slice(array_diff(array_keys($input), $this->allKeys), 0, self::MAX_DIFF_KEYS)
        )));
        $keysResult = $keys->evaluate($input);

        return (new Result($keysResult->hasPassed, $input, $this, [], $this->getTemplateFromKeys(array_keys($input))))
            ->withChildren(...($keysResult->children === [] ? [$keysResult] : $keysResult->children));
    }

    /**
     * @param array<Rule> $rules
     *
     * @return array<KeyRelated>
     */
    private function extractKeyRelatedRules(array $rules): array
    {
        $keyRelatedRules = [];
        foreach ($rules as $rule) {
            if ($rule instanceof KeyRelated) {
                $keyRelatedRules[] = $rule;
                continue;
            }

            if (!$rule instanceof Validator) {
                throw new InvalidRuleConstructorException('You must provide only key-related rules');
            }

            $keyRelatedRules = array_merge($keyRelatedRules, $this->extractKeyRelatedRules($rule->getRules()));
        }

        return $keyRelatedRules;
    }

    /** @param array<int|string> $keys */
    private function getTemplateFromKeys(array $keys): string
    {
        $extraKeys = array_diff($keys, $this->allKeys);
        $missingKeys = array_diff($this->mandatoryKeys, $keys);

        if ($extraKeys !== [] && $missingKeys !== []) {
            return self::TEMPLATE_BOTH;
        }

        if ($extraKeys !== []) {
            return self::TEMPLATE_EXTRA_KEYS;
        }

        if ($missingKeys !== []) {
            return self::TEMPLATE_MISSING_KEYS;
        }

        return self::TEMPLATE_STANDARD;
    }
}
