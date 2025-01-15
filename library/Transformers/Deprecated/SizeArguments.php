<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers\Deprecated;

use Respect\Validation\Rule;
use Respect\Validation\Rules\Between;
use Respect\Validation\Rules\Equals;
use Respect\Validation\Rules\GreaterThanOrEqual;
use Respect\Validation\Rules\LessThanOrEqual;
use Respect\Validation\Transformers\RuleSpec;
use Respect\Validation\Transformers\Transformer;

use function filter_var;
use function is_float;
use function is_int;
use function preg_replace;
use function Respect\Stringifier\stringify;
use function sprintf;
use function strtoupper;
use function trigger_error;

use const E_USER_DEPRECATED;
use const FILTER_VALIDATE_FLOAT;
use const FILTER_VALIDATE_INT;

final class SizeArguments implements Transformer
{
    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if ($ruleSpec->name !== 'size' || $ruleSpec->arguments === []) {
            return $this->next->transform($ruleSpec);
        }

        if (isset($ruleSpec->arguments[1]) && $ruleSpec->arguments[1] instanceof Rule) {
            return $this->next->transform($ruleSpec);
        }

        $minValue = $ruleSpec->arguments[0] ?? null;
        $maxValue = $ruleSpec->arguments[1] ?? null;

        $message = 'Calling size() with scalar values has been deprecated, ' .
            'and will not be allowed in the next major version. ';

        if (!$maxValue) {
            $unit = $this->getUnit($minValue);
            $numberValue = $this->getValue($minValue);
            trigger_error(
                sprintf($message . 'Use size(\'%s\', greaterThanOrEqual(%s)) instead.', $unit, stringify($numberValue)),
                E_USER_DEPRECATED
            );

            return new RuleSpec('size', [$unit, new GreaterThanOrEqual($numberValue)]);
        }

        if (!$minValue) {
            $unit = $this->getUnit($maxValue);
            $numberValue = $this->getValue($maxValue);
            trigger_error(
                sprintf($message . 'Use size(\'%s\', lessThanOrEqual(%s)) instead.', $unit, stringify($numberValue)),
                E_USER_DEPRECATED
            );

            return new RuleSpec('size', [$unit, new LessThanOrEqual($numberValue)]);
        }

        if ($minValue === $maxValue) {
            $unit = $this->getUnit($maxValue);
            $numberValue = $this->getValue($maxValue);
            trigger_error(
                sprintf($message . 'Use size(\'%s\', equals(%s)) instead.', $unit, stringify($numberValue)),
                E_USER_DEPRECATED
            );

            return new RuleSpec('size', [$unit, new Equals($numberValue)]);
        }

        $unit = $this->getUnit($maxValue);
        $minNumberValue = $this->getValue($minValue);
        $maxNumberValue = $this->getValue($maxValue);

        trigger_error(
            sprintf(
                $message . 'Use size(\'%s\', between(%s, %s)) instead.',
                $unit,
                stringify($minNumberValue),
                stringify($maxNumberValue),
            ),
            E_USER_DEPRECATED
        );

        return new RuleSpec('size', [$unit, new Between($minNumberValue, $maxNumberValue)]);
    }

    public function getValue(mixed $maxValue): int|float|string
    {
        if (is_int($maxValue) || is_float($maxValue)) {
            return $maxValue;
        }

        $filtered = preg_replace('/[^0-9.]/', '', $maxValue);
        if (filter_var($filtered, FILTER_VALIDATE_INT)) {
            return (int) $filtered;
        }

        if (filter_var($filtered, FILTER_VALIDATE_FLOAT)) {
            return (float) $filtered;
        }

        return $filtered;
    }

    private function getUnit(mixed $maxValue): string
    {
        if (is_int($maxValue)) {
            return 'B';
        }

        return strtoupper(preg_replace('/[0-9.]/', '', $maxValue));
    }
}
