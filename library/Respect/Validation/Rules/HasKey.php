<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\HasKeyException;
use Respect\Validation\Rules\All;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\ValidationException;

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

    public function validate($input)
    {
        return array_key_exists($this->key, $input)
        && parent::validate($input[$this->key]);
    }

    public function assert($input)
    {
        $keyExists = array_key_exists($this->key, $input);
        try {
            parent::assert(@$input[$this->key]);
        } catch (ValidationException $e) {
            throw $this->exception ? : HasKeyException::create()
                    ->configure($input, $this->key, $keyExists)
                    ->addRelated($e);
        }
        if (!$keyExists)
            throw $this->exception ? : HasKeyException::create()
                    ->configure($input, $this->key, false);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}