<?php
namespace Respect\Validation\Rules;

abstract class AbstractSearcher extends AbstractRule
{
    public $haystack;
    public $compareIdentical;

    protected function validateEquals($input)
    {
        if (is_array($this->haystack)) {
            return in_array($input, $this->haystack);
        }

        return (false !== mb_stripos($this->haystack, $input, 0, mb_detect_encoding($input)));
    }

    protected function validateIdentical($input)
    {
        if (is_array($this->haystack)) {
            return in_array($input, $this->haystack, true);
        }

        return (false !== mb_strpos($this->haystack, $input, 0, mb_detect_encoding($input)));
    }

    public function validate($input)
    {
        if ($this->compareIdentical) {
            return $this->validateIdentical($input);
        }

        return $this->validateEquals($input);
    }
}
