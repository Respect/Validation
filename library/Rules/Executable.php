<?php

namespace Respect\Validation\Rules;

class Executable extends AbstractRule
{
    public function validate($input)
    {
        if ($input instanceof \SplFileInfo) {
            return $input->isExecutable();
        }

        return (is_string($input) && is_executable($input));
    }
}
