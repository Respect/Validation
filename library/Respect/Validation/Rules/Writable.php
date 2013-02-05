<?php

namespace Respect\Validation\Rules;

class Writable extends AbstractRule
{

    public function validate($input)
    {
        if ($input instanceof \SplFileInfo) {
            return $input->isWritable();
        }

        return (is_string($input) && is_writable($input));
    }

}

