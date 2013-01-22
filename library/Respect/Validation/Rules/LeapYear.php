<?php
namespace Respect\Validation\Rules;

use DateTime;

class LeapYear extends AbstractRule
{
    public function validate($year)
    {
        if (is_numeric($year)) {
            $year = (int) $year;
        } elseif (is_string($year)) {
            $year = (int) date('Y', strtotime($year));
        } elseif ($year instanceof DateTime) {
            $year = (int) $year->format('Y');
        } else {
            return false;
        }

        $date = strtotime(sprintf('%d-02-29', $year));

        return (bool) date('L', $date);
    }
}

