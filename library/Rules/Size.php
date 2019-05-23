<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use SplFileInfo;
use function filesize;
use function is_numeric;
use function is_string;
use function preg_match;
use function sprintf;

/**
 * Validates whether the input is a file that is of a certain size or not.
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Size extends AbstractRule
{
    /**
     * @var string|null
     */
    private $minSize;

    /**
     * @var float|null
     */
    private $minValue;

    /**
     * @var string|null
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
        $this->minValue = $minSize ? $this->toBytes($minSize) : null;
        $this->maxSize = $maxSize;
        $this->maxValue = $maxSize ? $this->toBytes($maxSize) : null;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->isValidSize($input->getSize());
        }

        if (is_string($input)) {
            return $this->isValidSize((int) filesize($input));
        }

        return false;
    }

    /**
     * @todo Move it to a trait
     *
     * @param mixed $size
     */
    private function toBytes($size): float
    {
        $value = $size;
        $units = ['b', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb', 'zb', 'yb'];
        foreach ($units as $exponent => $unit) {
            if (!preg_match('/^(\d+(.\d+)?)'.$unit.'$/i', (string) $size, $matches)) {
                continue;
            }
            $value = $matches[1] * 1024 ** $exponent;
            break;
        }

        if (!is_numeric($value)) {
            throw new ComponentException(sprintf('"%s" is not a recognized file size.', (string) $size));
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
