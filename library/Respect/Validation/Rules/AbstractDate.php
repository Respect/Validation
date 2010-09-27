<?php

namespace Respect\Validation\Rules;

use DateTime;
use Respect\Validation\Rules\AbstractRule;

abstract class AbstractDate extends AbstractRule
{
    const FORMAT_DEFAULT = DateTime::RFC1036;
    protected $format = self::FORMAT_DEFAULT;

    protected function setFormat($format=self::FORMAT_DEFAULT)
    {
        $this->format = $format;
    }

    protected function getDateObject($date)
    {
        if ($date instanceof DateTime)
            return $date;
        else
            return new DateTime($date);
    }

    protected function formatDate(DateTime $date)
    {
        return $date->format($this->format);
    }

}