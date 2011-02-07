<?php

namespace Respect\Validation\Rules;

class Call extends AbstractRelated
{

    protected function getReferenceValue($input)
    {
        return call_user_func($this->reference, $input);
    }

    protected function hasReference($input)
    {
        return is_callable($this->reference);
    }

}