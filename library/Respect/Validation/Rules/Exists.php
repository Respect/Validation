<?php

namespace Respect\Validation\Rules;

class Exists extends AbstractRule
{

    public function validate($input)
    {
        if ($input instanceof \SplFileInfo) {
            $input = $input->getPathname();
        }

        return (is_string($input) && file_exists($input));
    }

}

