<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractDate;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\DateOutOfBoundsException;
use Respect\Validation\Exceptions\InvalidDate;
use Respect\Validation\Validator;

class DateBetween extends AbstractDate
{
    const MSG_OUT_OF_BOUNDS = 'DateBetween_1';

    protected $min;
    protected $max;
    protected $messageTemplates = array(
        self::MSG_OUT_OF_BOUNDS => '%s is not between %s and %s.'
    );

    public function __construct($min, $max, $format=null)
    {
        if (!Validator::date()->validate($min))
            throw new ComponentException(
                sprintf(
                    'Invalid Date: %s', $this->getStringRepresentation($min)
                )
            );
        if (!Validator::date()->validate($max))
            throw new ComponentException(
                sprintf(
                    'Invalid Date: %s', $this->getStringRepresentation($max)
                )
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
                sprintf(
                    $this->getMessageTemplate(self::MSG_OUT_OF_BOUNDS),
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