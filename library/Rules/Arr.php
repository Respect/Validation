<?php
namespace Respect\Validation\Rules;

use ArrayAccess;
use Countable;
use Traversable;

class Arr extends AbstractRule
{
    public function validate($input)
    {
        return is_array($input) || ($input instanceof ArrayAccess
            && $input instanceof Traversable
            && $input instanceof Countable);
    }
}

