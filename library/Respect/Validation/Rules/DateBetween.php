<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractDate;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\DateOutOfBoundsException;
use Respect\Validation\Exceptions\InvalidDate;
use Respect\Validation\Validator;

class DateBetween extends AbstractDate
{

    protected $min;
    protected $max;

    public function __construct($min, $max, $format=null)
    {
        if (!Validator::date()->validate($min))
            throw new ComponentException(
                'Invalid min date'
            );
        if (!Validator::date()->validate($max))
            throw new ComponentException(
                'Invalid max date'
            );
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
            throw new DateOutOfBoundsException(
                $this->formatDate($target),
                $this->formatDate($this->min),
                $this->formatDate($this->max)
            );
        return true;
    }

    public function validate($input)
    {
        $target = $this->getDateObject($input);
        return $target >= $this->min and $target <= $this->max;
    }

}