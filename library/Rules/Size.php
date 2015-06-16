<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use SplFileInfo;

/**
 * Validate file size.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class Size extends Between
{
    /**
     * @var string
     */
    public $minSize;

    /**
     * @var string
     */
    public $maxSize;

    /**
     * @param string $minSize
     * @param string $maxSize
     */
    public function __construct($minSize = null, $maxSize = null)
    {
        $minSizeBytes = $minSize;
        if (null !== $minSizeBytes) {
            $minSizeBytes = $this->toBytes($minSize);
        }
        $this->minSize = $minSize;

        $maxSizeBytes = $maxSize;
        if (null !== $maxSizeBytes) {
            $maxSizeBytes = $this->toBytes($maxSize);
        }
        $this->maxSize = $maxSize;

        parent::__construct($minSizeBytes, $maxSizeBytes, true);
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
        $units = array('b', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb', 'zb', 'yb');
        foreach ($units as $exponent => $unit) {
            if (!preg_match("/^(\d+(.\d+)?){$unit}$/i", $size, $matches)) {
                continue;
            }
            $value = $matches[1] * pow(1024, $exponent);
            break;
        }

        if (!is_numeric($value)) {
            throw new ComponentException(sprintf('"%s" is not a recognized file size.', $size));
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        if ($input instanceof SplFileInfo) {
            return parent::validate($input->getSize());
        }

        if (!is_string($input)) {
            return false;
        }

        return parent::validate(filesize($input));
    }
}
