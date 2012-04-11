<?php

namespace Respect\Validation\Rules;

class Directory extends AbstractRule
{

    public function validate($input)
    {
    	if ($input instanceof \SplFileInfo) {
    		return $input->isDir();
    	}
        return (is_string($input) && is_dir($input));
    }

}

