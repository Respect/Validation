<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\KeyNotPresentException;
use Respect\Validation\Rules\All;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validator;

class HasKey extends All
{
    const MSG_KEY_NOT_PRESENT = 'HasKey_1';
    protected $messageTemplates = array(
        self::MSG_KEY_NOT_PRESENT => 'Array does not have the key %s'
    );
    protected $key = '';

    public function __construct($key, $valueValidator=null)
    {
        if (!Validator::alnum()->validate($key))
            throw new ComponentException(
                sprintf(
                    '"%s" is not a valid key name',
                    $this->getStringRepresentation($key)
                )
            );
        $this->key = $key;
        if (!is_null($valueValidator))
            $this->addRule($valueValidator);
    }

    public function validate($input)
    {
        return @array_key_exists($this->key, $input)
        && parent::validate($input[$this->key]);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new KeyNotPresentException(
                sprintf(
                    $this->getMessageTemplate(self::MSG_KEY_NOT_PRESENT),
                    $this->key
                )
            );
        return parent::validate($input[$this->key]);
    }

}