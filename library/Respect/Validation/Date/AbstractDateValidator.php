<?php

namespace Respect\Validation\Date;

use DateTime;

abstract class AbstractDateValidator
{

    protected $format=DateTime::RFC1036;

    protected function setFormat($format=DateTime::RFC1036)
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