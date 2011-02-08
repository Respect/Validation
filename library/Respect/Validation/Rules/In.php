<?php

namespace Respect\Validation\Rules;

class In extends AbstractRule
{

    protected $options;
    protected $strict;

    public function __construct($options, $strict=false)
    {
        $this->options = $options;
        $this->strict = $strict;
    }

    public function reportError($input, array $related=array())
    {
        if (is_array($this->options))
            $options = implode(',', $this->options);
        else
            $options = $this->options;
        return parent::reportError($input, $related,
            $options, $this->strict);
    }

    public function validate($input)
    {
        if (is_array($this->options))
            return in_array($input, $this->options, $this->strict);
        elseif (is_string($this->options))
            if ($this->strict)
                return mb_strpos($this->options, $input) !== false;
            else
                return mb_stripos($this->options, $input) !== false;
        else
            return false;
    }

}