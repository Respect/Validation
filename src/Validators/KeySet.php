<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Ondřej Vodáček
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\ValidatorBuilder;
use Respect\Validation\Validators\Core\KeyRelated;
use Respect\Validation\Validators\Core\Reducer;

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
final readonly class KeySet implements Validator
{
    public const string TEMPLATE_BOTH = '__both__';
    public const string TEMPLATE_EXTRA_KEYS = '__extra_keys__';
    public const string TEMPLATE_MISSING_KEYS = '__missing_keys__';

    private const int MAX_DIFF_KEYS = 10;

    /** @var array<KeyRelated> */
    private array $validators;

    /** @var array<int|string> */
    private array $allKeys;

    /** @var array<int|string> */
    private array $mandatoryKeys;

    public function __construct(Validator $validator, Validator ...$validators)
    {
        $this->validators = $this->extractKeyRelatedValidators(array_merge([$validator], $validators));
        $this->allKeys = array_map(static fn(KeyRelated $validator) => $validator->getKey(), $this->validators);
        $this->mandatoryKeys = array_map(
            static fn(KeyRelated $validator) => $validator->getKey(),
            array_filter($this->validators, static fn(KeyRelated $validator) => !$validator instanceof KeyOptional),
        );
    }

    public function evaluate(mixed $input): Result
    {
        $arrayResult = (new ArrayType())->evaluate($input);
        if (!$arrayResult->hasPassed) {
            return $arrayResult;
        }

        $keys = new Reducer(...array_merge($this->validators, array_map(
            static fn(string|int $key) => new Not(new KeyExists($key)),
            array_slice(array_diff(array_keys($input), $this->allKeys), 0, self::MAX_DIFF_KEYS),
        )));
        $keysResult = $keys->evaluate($input);

        $template = $this->getTemplateFromKeys(array_keys($input));

        return Result::of($keysResult->hasPassed, $input, $this, [], $template)
            ->withChildren(...($keysResult->children === [] ? [$keysResult] : $keysResult->children));
    }

    /**
     * @param array<Validator> $validators
     *
     * @return array<KeyRelated>
     */
    private function extractKeyRelatedValidators(array $validators): array
    {
        $keyRelatedValidators = [];
        foreach ($validators as $validator) {
            if ($validator instanceof KeyRelated) {
                $keyRelatedValidators[] = $validator;
                continue;
            }

            if (!$validator instanceof ValidatorBuilder) {
                throw new InvalidValidatorException('You must provide only key-related rules');
            }

            $keyRelatedValidators = array_merge(
                $keyRelatedValidators,
                $this->extractKeyRelatedValidators($validator->getValidators()),
            );
        }

        return $keyRelatedValidators;
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
