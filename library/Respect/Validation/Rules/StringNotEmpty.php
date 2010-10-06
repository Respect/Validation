<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\EmptyStringException;
use Respect\Validation\Rules\AbstractRule;

class StringNotEmpty extends AbstractRule
{
    const MSG_EMPTY_STRING = 'StringNotEmpty_1';

    protected $messageTemplates = array(
        self::MSG_EMPTY_STRING => 'You provided an empty string'
    );

    public function validate($input)
    {
        $trimmed = trim($input);
        return!empty($trimmed);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new EmptyStringException(
                $this->getMessageTemplate(self::MSG_EMPTY_STRING)
            );
        return true;
    }

}