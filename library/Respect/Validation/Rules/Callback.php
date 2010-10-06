<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\CallbackException;

class Callback extends AbstractRule implements Validatable
{
    const MSG_CALLBACK = 'Callback_1';
    protected $messageTemplates = array(
        self::MSG_CALLBACK => '%s does not validate against the provided callback.'
    );
    protected $callback;

    public function __construct($callback)
    {
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