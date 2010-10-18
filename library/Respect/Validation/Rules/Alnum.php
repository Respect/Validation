<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotAlphanumericException;
use Respect\Validation\Exceptions\ComponentException;

class Alnum extends AbstractRule
{
    const MSG_NOT_ALPHANUMERIC = 'Alnum_1';
    const MSG_NOT_ALPHANUMERIC_ADDITIONAL = 'Alnum_2';
    protected $messageTemplates = array(
        self::MSG_NOT_ALPHANUMERIC => '"%s" does not contains only letters and digits',
        self::MSG_NOT_ALPHANUMERIC_ADDITIONAL => '"%s" does not contains only letters and digits (including "%s")'
    );
    protected $additionalChars = '';

    public function __construct($additionalChars='')
    {
        if (!is_string($additionalChars))
            throw new ComponentException(
                sprintf(
                    '"%s" is not a valid list of additional characters to be loaded',
                    $this->getStringRepresentation($additionalChars)
                )
            );
        $this->additionalChars = $additionalChars;
    }

    public function validate($input)
    {
        return is_string($input) && preg_match(
            "#^[a-zA-Z0-9]+$#",
            str_replace(str_split($this->additionalChars), '', $input)
        );
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            if (empty($this->additionalChars))
                throw new NotAlphanumericException(
                    sprintf(
                        $this->getMessageTemplate(self::MSG_NOT_ALPHANUMERIC),
                        $this->getStringRepresentation($input)
                    )
                );
            else
                throw new NotAlphanumericException(
                    sprintf(
                        $this->getMessageTemplate(self::MSG_NOT_ALPHANUMERIC_ADDITIONAL),
                        $this->getStringRepresentation($input),
                        $this->additionalChars
                    )
                );
        return true;
    }

}