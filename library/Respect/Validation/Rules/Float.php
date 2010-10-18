<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotFloatException;

class Float extends AbstractRule
{
    const MSG_NOT_FLOAT = 'Float_1';
    protected $messageTemplates = array(
        self::MSG_NOT_FLOAT => '%s is not a valid float number'
    );

    public function validate($input)
    {
        return filter_var($input, FILTER_VALIDATE_FLOAT);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotFloatException(
                sprintf($this->getMessageTemplate(self::MSG_NOT_FLOAT), $input)
            );
        return true;
    }

}