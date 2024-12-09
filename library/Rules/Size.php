<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;
use SplFileInfo;

use function filesize;
use function floatval;
use function is_numeric;
use function is_string;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be between {{minSize}} and {{maxSize}}',
    '{{name}} must not be between {{minSize}} and {{maxSize}}',
    self::TEMPLATE_BOTH,
)]
#[Template(
    '{{name}} must be greater than {{minSize}}',
    '{{name}} must not be greater than {{minSize}}',
    self::TEMPLATE_LOWER,
)]
#[Template(
    '{{name}} must be lower than {{maxSize}}',
    '{{name}} must not be lower than {{maxSize}}',
    self::TEMPLATE_GREATER,
)]
final class Size extends Standard
{
    public const TEMPLATE_LOWER = '__lower__';
    public const TEMPLATE_GREATER = '__greater__';
    public const TEMPLATE_BOTH = '__both__';

    private readonly ?float $minValue;

    private readonly ?float $maxValue;

    public function __construct(
        private readonly string|int|null $minSize = null,
        private readonly string|int|null $maxSize = null
    ) {
        $this->minValue = $minSize ? $this->toBytes((string) $minSize) : null;
        $this->maxValue = $maxSize ? $this->toBytes((string) $maxSize) : null;
    }

    public function evaluate(mixed $input): Result
    {
        return new Result(
            $this->isValid($input),
            $input,
            $this,
            ['minSize' => $this->minSize, 'maxSize' => $this->maxSize],
            $this->getStandardTemplate()
        );
    }

    private function isValid(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->isValidSize((float) $input->getSize());
        }

        if ($input instanceof UploadedFileInterface) {
            return $this->isValidSize((float) $input->getSize());
        }

        if ($input instanceof StreamInterface) {
            return $this->isValidSize((float) $input->getSize());
        }

        if (is_string($input)) {
            return $this->isValidSize((float) filesize($input));
        }

        return false;
    }

    private function getStandardTemplate(): string
    {
        if (!$this->minValue) {
            return self::TEMPLATE_GREATER;
        }

        if (!$this->maxValue) {
            return self::TEMPLATE_LOWER;
        }

        return self::TEMPLATE_BOTH;
    }

    /**
     * @todo Move it to a trait
     */
    private function toBytes(string $size): float
    {
        $value = $size;
        $units = ['b', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb', 'zb', 'yb'];
        foreach ($units as $exponent => $unit) {
            if (!preg_match('/^(\d+(.\d+)?)' . $unit . '$/i', $size, $matches)) {
                continue;
            }
            $value = floatval($matches[1]) * 1024 ** $exponent;
            break;
        }

        if (!is_numeric($value)) {
            throw new InvalidRuleConstructorException('"%s" is not a recognized file size.', $size);
        }

        return (float) $value;
    }

    private function isValidSize(float $size): bool
    {
        if ($this->minValue !== null && $this->maxValue !== null) {
            return $size >= $this->minValue && $size <= $this->maxValue;
        }

        if ($this->minValue !== null) {
            return $size >= $this->minValue;
        }

        return $size <= $this->maxValue;
    }
}
