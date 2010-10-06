<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotAlphanumericException;

class Alnum extends AbstractRule 
{
    const MSG_NOT_ALPHANUMERIC = 'Alnum_1';
    const MSG_NOT_ALPHANUMERIC_ADDITIONAL = 'Alnum_2';
    protected $messageTemplates = array(
        self::MSG_NOT_ALPHANUMERIC => '%s does not contains only letters and digits',
        self::MSG_NOT_ALPHANUMERIC_ADDITIONAL => '%s does not contains only letters and digits (including %s)'
    );
    protected $additionalChars = '';

    public function __construct($additionalChars='')
    {
        $this->additionalChars = $additionalChars;
    }

    public function validate($input)
    {
        return (boolean) preg_match(
            "#^[a-zA-Z0-9\s{$this->additionalChars}]+$#", $input
        );
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            if (empty($this->additionalChars))
                throw new NotAlphanumericException(
                    sprintf($this->getMessageTemplate(self::MSG_NOT_ALPHANUMERIC),
                        $input)
                );
            else
                throw new NotAlphanumericException(
                    sprintf(
                        $this->getMessageTemplate(self::MSG_NOT_ALPHANUMERIC_ADDITIONAL),
                        $input, $this->additionalChars
                    )
                );
        return true;
    }

}