<?php

namespace Respect\Validation\Rules;

class Bic extends AbstractRule
{

    public function validate($input)
    {
        return eregi("^([a-zA-Z]){4}([a-zA-Z]){2}([0-9a-zA-Z]){2}([0-9a-zA-Z]{3})?$", $input) && true;
    }

}
