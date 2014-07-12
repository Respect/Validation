<?php

namespace Respect\Validation\Rules;

class Uploaded extends AbstractRule
{

    public function validate($input)
    {
        if ($input instanceof \SplFileInfo) {
            $input = $input->getPathname();
        }

        return (is_string($input) && is_uploaded_file($input));
    }

}

