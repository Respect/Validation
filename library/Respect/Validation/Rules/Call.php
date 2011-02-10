<?php

namespace Respect\Validation\Rules;

class Call extends AbstractRelated
{

    public function getReferenceValue($input)
    {
        return call_user_func($this->reference, $input);
    }

    public function hasReference($input)
    {
        return is_callable($this->reference);
    }

}
