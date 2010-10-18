<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotAlphaException;
use Respect\Validation\Exceptions\ComponentException;

class Alpha extends AbstractRule
{
    const MSG_NOT_ALPHA = 'Alpha_1';
    const MSG_NOT_ALPHA_ADDITIONAL = 'Alpha_2';
    protected $messageTemplates = array(
        self::MSG_NOT_ALPHA => '"%s" does not contains only letters',
        self::MSG_NOT_ALPHA_ADDITIONAL => '"%s" does not contains only letters (including "%s")'
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
            "#^[a-zA-Z]+$#",
            str_replace(str_split($this->additionalChars), '', $input)
        );
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            if (empty($this->additionalChars))
                throw new NotAlphaException(
                    sprintf(
                        $this->getMessageTemplate(self::MSG_NOT_ALPHA),
                        $this->getStringRepresentation($input)
                    )
                );
            else
                throw new NotAlphaException(
                    sprintf(
                        $this->getMessageTemplate(self::MSG_NOT_ALPHA_ADDITIONAL),
                        $this->getStringRepresentation($input),
                        $this->additionalChars
                    )
                );
        return true;
    }

}