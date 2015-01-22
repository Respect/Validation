<?php
namespace Respect\Validation\Rules;

class True extends AbstractRule
{
    public function validate($input)
    {
        if (! is_string($input) || is_numeric($input)) {
            return ($input == true);
        }

        $validValues   = array(
            'on',
            'true',
            'yes',
        );
        $filteredInput = strtolower($input);

        return in_array($filteredInput, $validValues);
    }
}
