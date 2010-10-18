<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\CallbackException;
use Respect\Validation\Exceptions\ComponentException;

class Callback extends AbstractRule
{
    const MSG_CALLBACK = 'Callback_1';
    protected $messageTemplates = array(
        self::MSG_CALLBACK => '%s does not validate against the provided callback.'
    );
    protected $callback;

    public function __construct($callback)
    {
        if (!is_callable($callback))
            throw new ComponentException(
                sprintf(
                    '"%s is not a valid callback',
                    $this->getStringRepresentation($callback)
                )
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
            throw new CallbackException(
                sprintf($this->getMessageTemplate(self::MSG_CALLBACK),
                    $this->getStringRepresentation($input)
                )
            );
        return true;
    }

}