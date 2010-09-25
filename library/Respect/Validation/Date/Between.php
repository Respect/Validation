<?php

namespace Respect\Validation\Date;

use Respect\Validation\Validatable;
use Respect\Validation\ComponentException;

class Between extends AbstractDateValidator implements Validatable
{
    const MSG_OUT_OF_BOUNDS = 'Date_Between_1';

    protected $min;
    protected $max;
    protected $messages = array(
        self::MSG_OUT_OF_BOUNDS => '%s is not between %s and %s.'
    );

    public function __construct($min, $max, $format=null)
    {

        $this->min = $this->getDateObject($min);
        $this->max = $this->getDateObject($max);
        if ($this->min > $this->max)
            throw new ComponentException(
                sprintf('%s cannot be less than  %s for validation',
                    $this->formatDate($this->min), $this->formatDate($this->max))
            );
        if (!is_null($format))
            $this->setFormat($format);
    }

    public function assert($input)
    {
        $target = $this->getDateObject($input);
        if (!$this->validate($target))
            throw new OutOfBoundsException(
                sprintf(
                    $this->getMessage(self::MSG_OUT_OF_BOUNDS),
                    $this->formatDate($target), $this->formatDate($this->min),
                    $this->formatDate($this->max)
                )
            );
        return true;
    }

    public function validate($input)
    {
        $target = $this->getDateObject($input);
        return $target >= $this->min and $target <= $this->max;
    }

}