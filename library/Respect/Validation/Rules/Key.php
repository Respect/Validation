<?php

namespace Respect\Validation\Rules;

class Key extends AbstractRelated
{

    protected function hasReference($input)
    {
        return array_key_exists($this->reference, $input);
    }

    protected function getReferenceValue($input)
    {
        return @$input[$this->reference];
    }

}