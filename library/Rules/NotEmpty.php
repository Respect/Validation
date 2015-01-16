<?php
namespace Respect\Validation\Rules;

class NotEmpty extends AbstractRule
{
    /** Wheter to juggle PHP types **/
    public $jugglesTypes = true;

    public function __construct($jugglesTypes = true)
    {
        $this->jugglesTypes = $jugglesTypes;
    }

    public function validate($input)
    {
        if (!is_string($input)) {
            return !empty($input);
        }

        $input = trim($input);

        if ($this->jugglesTypes) {
            return !empty($input);
        }

        return '' !== $input;
    }

    public function __invoke($input)
    {
        return $this->validate($input);
    }
}
