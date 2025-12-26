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
use Respect\Validation\Validator;

use function array_diff;
use function array_filter;
use function array_keys;
use function array_map;
use function array_merge;
use function array_slice;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} validation failed',
    '{{subject}} validation passed',
)]
#[Template(
    '{{subject}} contains both missing and extra keys',
    '{{subject}} contains no missing or extra keys.',
    self::TEMPLATE_BOTH,
)]
#[Template(
    '{{subject}} contains extra keys',
    '{{subject}} contains no extra keys',
    self::TEMPLATE_EXTRA_KEYS,
)]
#[Template(
    '{{subject}} contains missing keys',
    '{{subject}} contains no missing keys',
    self::TEMPLATE_MISSING_KEYS,
)]
final readonly class KeySet implements Rule
{
    public const string TEMPLATE_BOTH = '__both__';
    public const string TEMPLATE_EXTRA_KEYS = '__extra_keys__';
    public const string TEMPLATE_MISSING_KEYS = '__missing_keys__';

    private const int MAX_DIFF_KEYS = 10;

    /** @var array<KeyRelated> */
    private array $rules;

    /** @var array<int|string> */
    private array $allKeys;

    /** @var array<int|string> */
    private array $mandatoryKeys;

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
            array_slice(array_diff(array_keys($input), $this->allKeys), 0, self::MAX_DIFF_KEYS),
        )));
        $keysResult = $keys->evaluate($input);

        $template = $this->getTemplateFromKeys(array_keys($input));

        return Result::of($keysResult->hasPassed, $input, $this, [], $template)
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
