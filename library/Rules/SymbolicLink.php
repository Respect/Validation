<?php

namespace Respect\Validation\Rules;

class SymbolicLink extends AbstractRule
{

    public function validate($input)
    {
        if ($input instanceof \SplFileInfo) {
            return $input->isLink();
        }

        return (is_string($input) && is_link($input));
    }

}

