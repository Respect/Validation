<?php

namespace Respect\Validation\Rules;

class Readable extends AbstractRule
{

    public function validate($input)
    {
        if ($input instanceof \SplFileInfo) {
            return $input->isReadable();
        }

        return (is_string($input) && is_readable($input));
    }

}

