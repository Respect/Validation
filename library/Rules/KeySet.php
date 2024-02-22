<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Helpers\CanExtractRules;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;
use Respect\Validation\Validatable;

use function array_diff;
use function array_keys;
use function array_map;
use function array_merge;
use function array_values;
use function count;

#[Template(
    'Must have keys {{missingKeys}} in {{name}}',
    'Must not have keys {{missingKeys}} in {{name}}',
    self::TEMPLATE_MISSING,
)]
#[Template(
    'Must not have keys {{extraKeys}} in {{name}}',
    'Must have keys {{extraKeys}} in {{name}}',
    self::TEMPLATE_EXTRA,
)]
final class KeySet extends Wrapper
{
    use CanBindEvaluateRule;
    use CanExtractRules;

    public const TEMPLATE_MISSING = '__missing__';
    public const TEMPLATE_EXTRA = '__extra__';

    /** @var array<string|int> */
    private readonly array $keys;

    public function __construct(Validatable $rule, Validatable ...$rules)
    {
        /** @var array<Key> $keyRules */
        $keyRules = $this->extractMany(array_merge([$rule], $rules), Key::class);

        $this->keys = array_map(static fn(Key $keyRule) => $keyRule->getKey(), $keyRules);

        parent::__construct(count($keyRules) === 1 ? $keyRules[0] : new AllOf(...$keyRules));
    }

    public function evaluate(mixed $input): Result
    {
        $result = $this->bindEvaluate(new ArrayType(), $this, $input);
        if (!$result->isValid) {
            return $result;
        }

        $inputKeys = array_keys($input);

        $missingKeys = array_diff($this->keys, $inputKeys);
        if (count($missingKeys) > 0) {
            return Result::failed($input, $this, ['missingKeys' => array_values($missingKeys)], self::TEMPLATE_MISSING);
        }

        $extraKeys = array_diff($inputKeys, $this->keys);
        if (count($extraKeys) > 0) {
            return Result::failed($input, $this, ['extraKeys' => array_values($extraKeys)], self::TEMPLATE_EXTRA);
        }

        return parent::evaluate($input);
    }
}
