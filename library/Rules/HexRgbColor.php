<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Validator as v;

class HexRgbColor extends Xdigit
{
    public function validate($input)
    {
        if (!is_string($input)) {
            return false;
        }

        if (0 === strpos($input, '#')) {
            $input = substr($input, 1);
        }

        $length = strlen($input);
        if ($length != 3 && $length != 6) {
            return false;
        }

        return parent::validate($input);
    }
}
