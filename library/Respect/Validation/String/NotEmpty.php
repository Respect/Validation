<?php

namespace Respect\Validation\String;

use Respect\Validation\Validatable;
use Respect\Validation\AbstractNode;

class NotEmpty extends AbstractNode implements Validatable
{

    public function is($input)
    {
        $trimmed = trim($input);
        return!empty($trimmed);
    }

    public function assert($input)
    {
        if (!$this->is($input))
            throw new Exception();
    }

}