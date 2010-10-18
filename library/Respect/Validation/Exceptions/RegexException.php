<?php

namespace Respect\Validation\Exceptions;

use Exception;

class RegexException extends InvalidException
{
    const MSG_REGEX = 'Regex_1';
    protected $messageTemplates = array(
        self::MSG_REGEX => '%s does not validate against the provided regular expression: %s.'
    );

    public function __construct($input, $regex)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_REGEX),
                    $this->getStringRepresentation($input), $regex
                )
        );
    }

}