<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use SplFileInfo;

/**
 * Validate file size.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class Size extends AbstractRule
{
    /**
     * @var string
     */
    public $minSize;

    /**
     * @var int
     */
    public $minValue;

    /**
     * @var string
     */
    public $maxSize;

    /**
     * @var int
     */
    public $maxValue;

    /**
     * @param string $minSize
     * @param string $maxSize
     */
    public function __construct($minSize = null, $maxSize = null)
    {
        $this->minSize = $minSize;
        $this->minValue = $minSize ? $this->toBytes($minSize) : null;
        $this->maxSize = $maxSize;
        $this->maxValue = $maxSize ? $this->toBytes($maxSize) : null;
    }

    /**
     * @todo Move it to a trait
     *
     * @param mixed $size
     *
     * @return int
     */
    private function toBytes($size)
    {
        $value = $size;
        $units = ['b', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb', 'zb', 'yb'];
        foreach ($units as $exponent => $unit) {
            if (!preg_match("/^(\d+(.\d+)?){$unit}$/i", (string) $size, $matches)) {
                continue;
            }
            $value = $matches[1] * 1024 ** $exponent;
            break;
        }

        if (!is_numeric($value)) {
            throw new ComponentException(sprintf('"%s" is not a recognized file size.', $size));
        }

        return $value;
    }

    /**
     * @param int $size
     *
     * @return bool
     */
    private function isValidSize($size)
    {
        if (null !== $this->minValue && null !== $this->maxValue) {
            return $size >= $this->minValue && $size <= $this->maxValue;
        }

        if (null !== $this->minValue) {
            return $size >= $this->minValue;
        }

        return $size <= $this->maxValue;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        if ($input instanceof SplFileInfo) {
            return $this->isValidSize($input->getSize());
        }

        if (is_string($input)) {
            return $this->isValidSize(filesize($input));
        }

        return false;
    }
}
