<?php
namespace Respect\Validation\Rules;

abstract class AbstractCtypeRule extends AbstractFilterRule
{
    abstract protected function ctypeFunction($input);

    protected function filterWhiteSpaceOption($input)
    {
        if (empty($this->additionalChars))
            return preg_replace('/\s/', '', $input);
        return parent::filter($input);
    }

    public function validateClean($input)
    {
        return $this->ctypeFunction($input);
    }
}

