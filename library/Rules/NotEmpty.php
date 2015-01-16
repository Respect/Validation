<?php
namespace Respect\Validation\Rules;

class NotEmpty extends AbstractRule
{
    /** Wheter to juggle PHP types **/
    public $strict = false;

    public function __construct($strict = false)
    {
        $this->strict = $strict;
    }

    public function validate($input)
    {
        if (!is_string($input)) {
            return !empty($input);
        }

        $input = trim($input);

        if (!$this->strict) {
            return !empty($input);
        }

        return '' !== $input;
    }

    public function __invoke($input)
    {
        return $this->validate($input);
    }
}
