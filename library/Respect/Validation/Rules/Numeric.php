<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotNumericException;

class Numeric extends AbstractRule
{
    const MSG_NOT_NUMERIC = 'Numeric_1';
    protected $messageTemplates = array(
        self::MSG_NOT_NUMERIC => '%s is not a numeric value'
    );

    public function validate($input)
    {
        return is_numeric($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotNumericException(
                sprintf($this->getMessageTemplate(self::MSG_NOT_NUMERIC), $input)
            );
        return true;
    }

}