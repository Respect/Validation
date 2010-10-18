<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\RegexException;

class Regex extends AbstractRule
{
    const MSG_REGEX = 'Regex_1';
    protected $messageTemplates = array(
        self::MSG_REGEX => '%s does not validate against the provided regular expression: %s.'
    );
    protected $regex;

    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    public function validate($input)
    {
        return preg_match("/{$this->regex}/", $input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new RegexException(
                sprintf(
                    $this->getMessageTemplate(self::MSG_REGEX),
                    $this->getStringRepresentation($input), $this->regex
                )
            );
        return true;
    }

}