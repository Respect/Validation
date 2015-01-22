<?php
namespace Respect\Validation\Rules;

class False extends AbstractRule
{
    public function validate($input)
    {
        if (! is_string($input) || is_numeric($input)) {
            return ($input == false);
        }

        $validValues   = array(
            'false',
            'no',
            'off',
        );
        $filteredInput = strtolower($input);

        return in_array($filteredInput, $validValues);
    }
}
