<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\BaseException;

class Base extends AbstractRule
{
    public $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public $base;

    public function __construct($base=null, $chars=null)
    {
        if (!is_null($chars)) {
            $this->chars = $chars;
        }

        $max = strlen($this->chars);
        if (!is_numeric($base) || $base > $max) {
            throw new BaseException(sprintf('a base between 1 and %s is required', $max));
        }
        $this->base = $base;
    }

    public function validate($input)
    {
        $valid = substr($this->chars, 0, $this->base);

        return (boolean) preg_match("@^[$valid]+$@", (string) $input);
    }
}

