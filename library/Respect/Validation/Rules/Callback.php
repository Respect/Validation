<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

class Callback extends AbstractRule
{

    public $callback;

    public function __construct($callback)
    {
        if (!is_callable($callback))
            throw new ComponentException(
                'Invalid callback'
            );
        $this->callback = $callback;
    }

    public function validate($input)
    {
        return (bool) call_user_func($this->callback, $input);
    }

}

