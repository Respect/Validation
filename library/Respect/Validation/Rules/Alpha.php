<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotAlphaException;

class Alpha extends AbstractRule
{
    const MSG_NOT_ALPHA = 'Alpha_1';
    const MSG_NOT_ALPHA_ADDITIONAL = 'Alpha_2';
    protected $messageTemplates = array(
        self::MSG_NOT_ALPHA => '%s does not contains only letters',
        self::MSG_NOT_ALPHA_ADDITIONAL => '%s does not contains only letters (including %s)'
    );
    protected $additionalChars = '';

    public function __construct($additionalChars='')
    {
        $this->additionalChars = $additionalChars;
    }

    public function validate($input)
    {
        return (boolean) preg_match(
            "#^[a-zA-Z{$this->additionalChars}]+$#", $input
        );
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            if (empty($this->additionalChars))
                throw new NotAlphaException(
                    sprintf($this->getMessageTemplate(self::MSG_NOT_ALPHA),
                        $input)
                );
            else
                throw new NotAlphaException(
                    sprintf(
                        $this->getMessageTemplate(self::MSG_NOT_ALPHA_ADDITIONAL),
                        $input, $this->additionalChars
                    )
                );
        return true;
    }

}