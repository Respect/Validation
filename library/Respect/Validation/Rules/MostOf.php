<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\MostOfException;

class MostOf extends AtLeast
{

    public function __construct()
    {
        $this->howMany = ceil(func_num_args() / 2);
        $this->addRules(func_get_args());
    }
    public function createException()
    {
        return new MostOfException;
    }


}