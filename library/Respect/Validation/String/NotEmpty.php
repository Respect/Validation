<?php

namespace Respect\Validation\String;

use Respect\Validation\Validatable;
use Respect\Validation\AbstractRule;

class NotEmpty extends AbstractRule implements Validatable
{
    const MSG_EMPTY_STRING = 'String_NotEmpty_1';

    protected $messages = array(
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
                $this->getMessage(self::MSG_EMPTY_STRING)
            );
    }

}