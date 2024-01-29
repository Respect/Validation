<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Respect\Validation\Exceptions\ComponentException;
use SplFileInfo;

use function filesize;
use function floatval;
use function is_numeric;
use function is_string;
use function preg_match;
use function sprintf;

final class Size extends AbstractRule
{
    public const TEMPLATE_LOWER = 'lower';
    public const TEMPLATE_GREATER = 'greater';
    public const TEMPLATE_BOTH = 'both';

    private readonly ?float $minValue;

    private readonly ?float $maxValue;

    public function __construct(
        private string|int|null $minSize = null,
        private string|int|null $maxSize = null
    ) {
        $this->minValue = $minSize ? $this->toBytes((string) $minSize) : null;
        $this->maxValue = $maxSize ? $this->toBytes((string) $maxSize) : null;
    }

    public function validate(mixed $input): bool
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

    public function getTemplate(mixed $input): string
    {
        if ($this->template !== null) {
            return $this->template;
        }

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
            throw new ComponentException(sprintf('"%s" is not a recognized file size.', $size));
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
