<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\CallbackException;
use Respect\Validation\Exceptions\ComponentException;

class Callback extends AbstractRule
{

    protected $callback;

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
        return call_user_func($this->callback, $input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->getException() ? : CallbackException::create()
                    ->configure($input, $this->callback);
        return true;
    }

}