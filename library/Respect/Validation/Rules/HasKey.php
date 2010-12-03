<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\HasKeyException;
use Respect\Validation\Rules\All;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validator;

class HasKey extends AllOf
{

    protected $key = '';

    public function __construct($key, $valueValidator=null)
    {
        if (!Validator::alnum()->validate($key))
            throw new ComponentException(
                'Invalid key name'
            );
        $this->key = $key;
        if (!is_null($valueValidator))
            $this->addRule($valueValidator);
    }
    public function createException()
    {
        return new HasKeyException;
    }


    public function validate($input)
    {
        return array_key_exists($this->key, $input)
        && parent::validate($input[$this->key]);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this
                ->getException()
                ->configure($input, $this->key);
        return parent::validate(@$input[$this->key]);
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}