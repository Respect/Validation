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

/**
 * Validates whether the input is a file that is of a certain size or not.
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Felipe Stival <v0idpwn@gmail.com>
 */
final class Size extends AbstractRule
{
    /**
     * @var string|int|null
     */
    private $minSize;

    /**
     * @var float|null
     */
    private $minValue;

    /**
     * @var string|int|null
     */
    private $maxSize;

    /**
     * @var float|null
     */
    private $maxValue;

    /**
     * @param string|int|null $minSize
     * @param string|int|null $maxSize
     */
    public function __construct($minSize = null, $maxSize = null)
    {
        $this->minSize = $minSize;
        $this->minValue = $minSize ? $this->toBytes((string) $minSize) : null;
        $this->maxSize = $maxSize;
        $this->maxValue = $maxSize ? $this->toBytes((string) $maxSize) : null;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
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

    /**
     * @todo Move it to a trait
     *
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
