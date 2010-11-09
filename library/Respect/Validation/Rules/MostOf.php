<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidException;

class MostOf extends AtLeast
{

    public function __construct()
    {
        $this->howMany = ceil(func_num_args() / 2);
        $this->addRules(func_get_args());
    }

}