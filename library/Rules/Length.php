<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Countable as CountableInterface;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\Template;

use function count;
use function get_object_vars;
use function is_array;
use function is_int;
use function is_object;
use function is_string;
use function mb_strlen;
use function sprintf;

#[Template(
    '{{name}} must have a length between {{minValue}} and {{maxValue}}',
    '{{name}} must not have a length between {{minValue}} and {{maxValue}}',
    self::TEMPLATE_BOTH,
)]
#[Template(
    '{{name}} must have a length greater than {{minValue}}',
    '{{name}} must not have a length greater than {{minValue}}',
    self::TEMPLATE_LOWER,
)]
#[Template(
    '{{name}} must have a length greater than or equal to {{minValue}}',
    '{{name}} must not have a length greater than or equal to {{minValue}}',
    self::TEMPLATE_LOWER_INCLUSIVE,
)]
#[Template(
    '{{name}} must have a length lower than {{maxValue}}',
    '{{name}} must not have a length lower than {{maxValue}}',
    self::TEMPLATE_GREATER,
)]
#[Template(
    '{{name}} must have a length lower than or equal to {{maxValue}}',
    '{{name}} must not have a length lower than or equal to {{maxValue}}',
    self::TEMPLATE_GREATER_INCLUSIVE,
)]
#[Template(
    '{{name}} must have a length of {{maxValue}}',
    '{{name}} must not have a length of {{maxValue}}',
    self::TEMPLATE_EXACT,
)]
final class Length extends AbstractRule
{
    public const TEMPLATE_LOWER = 'lower';
    public const TEMPLATE_GREATER = 'greater';
    public const TEMPLATE_GREATER_INCLUSIVE = 'greater_inclusive';
    public const TEMPLATE_EXACT = 'exact';
    public const TEMPLATE_LOWER_INCLUSIVE = 'lower_inclusive';
    public const TEMPLATE_BOTH = 'both';

    public function __construct(
        private readonly ?int $minValue = null,
        private readonly ?int $maxValue = null,
        private readonly bool $inclusive = true
    ) {

        if ($maxValue !== null && $minValue > $maxValue) {
            throw new ComponentException(sprintf('%d cannot be less than %d for validation', $minValue, $maxValue));
        }
    }

    public function validate(mixed $input): bool
    {
        $length = $this->extractLength($input);
        if ($length === null) {
            return false;
        }

        return $this->validateMin($length) && $this->validateMax($length);
    }

    public function getTemplate(mixed $input): string
    {
        if ($this->template !== null) {
            return $this->template;
        }

        if (!$this->minValue) {
            return $this->inclusive === true ? self::TEMPLATE_GREATER_INCLUSIVE : self::TEMPLATE_GREATER;
        }

        if (!$this->maxValue) {
            return $this->inclusive === true ? self::TEMPLATE_LOWER_INCLUSIVE : self::TEMPLATE_LOWER;
        }

        if ($this->minValue == $this->maxValue) {
            return self::TEMPLATE_EXACT;
        }

        return self::TEMPLATE_BOTH;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return [
            'minValue' => $this->minValue,
            'maxValue' => $this->maxValue,
        ];
    }

    private function extractLength(mixed $input): ?int
    {
        if (is_string($input)) {
            return (int) mb_strlen($input);
        }

        if (is_array($input) || $input instanceof CountableInterface) {
            return count($input);
        }

        if (is_object($input)) {
            return $this->extractLength(get_object_vars($input));
        }

        if (is_int($input)) {
            return $this->extractLength((string) $input);
        }

        return null;
    }

    private function validateMin(int $length): bool
    {
        if ($this->minValue === null) {
            return true;
        }

        if ($this->inclusive) {
            return $length >= $this->minValue;
        }

        return $length > $this->minValue;
    }

    private function validateMax(int $length): bool
    {
        if ($this->maxValue === null) {
            return true;
        }

        if ($this->inclusive) {
            return $length <= $this->maxValue;
        }

        return $length < $this->maxValue;
    }
}
