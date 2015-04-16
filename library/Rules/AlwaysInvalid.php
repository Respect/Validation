<?php
namespace Respect\Validation\Rules;

class AlwaysInvalid extends AbstractRule
{
    public function __invoke($input)
    {
        return $this->validate($input);
    }

    public function validate($input)
    {
        return false;
    }
}
