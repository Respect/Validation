<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Validator as v;

class HexRgbColor extends AbstractRule
{
    public function validate($input)
    {
        if (v::oneOf(v::object(), v::arr(), v::nullValue(), v::not(v::string()))->validate($input)) {
            return false;
        }

        if (!v::startsWith('#')->validate($input)) {
            $input = '#'.$input;
        }

        $length = strlen($input) - 1;

        if ($length != 3 && $length != 6) {
            return false;
        }

        $hexdec = hexdec(substr($input, 1));

        return v::xdigit()->validate(substr($input, 1))
                        && $hexdec < 16777216 && $hexdec >= 0;
    }
}
