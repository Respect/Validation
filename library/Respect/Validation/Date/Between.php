<?php

namespace Respect\Validation\Date;

use Respect\Validation\Validatable;
use Respect\Validation\ComponentException;

class Between extends AbstractDateValidator implements Validatable
{

    protected $min;
    protected $max;

    public function __construct($min, $max, $format=null)
    {

        $this->min = $this->getDateObject($min);
        $this->max = $this->getDateObject($max);
        if ($this->min > $this->max)
            throw new ComponentException(
                sprintf('%s cannot be less than  %s for validation', $this->formatDate($this->min), $this->formatDate($this->max))
            );
        if (!is_null($format))
            $this->setFormat($format);
    }

    public function validate($input)
    {
        $target = $this->getDateObject($input);
        if (!$this->isValid($target))
            throw new OutOfBoundsException(
                sprintf(
                    '%s is not between %s and %s.', $this->formatDate($target), $this->formatDate($this->min), $this->formatDate($this->max)
                )
            );
        return true;
    }

    public function isValid($input)
    {
        $target = $this->getDateObject($input);
        return $target >= $this->min and $target <= $this->max;
    }

    public function getMessages()
    {
        
    }

    public function setMessages(array $messages)
    {
        
    }

}