<?php
namespace Respect\Validation\Rules;

class Float extends AbstractRule
{
    public function validate($input)
    {
        $localeData = localeconv();
        return is_float(filter_var($input, FILTER_VALIDATE_FLOAT, array("options"=>array('decimal' => $localeData['decimal_point']))));
    }
}
