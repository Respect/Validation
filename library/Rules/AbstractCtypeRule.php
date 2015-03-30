<?php
namespace Respect\Validation\Rules;

abstract class AbstractCtypeRule extends AbstractFilterRule
{
    abstract protected function ctypeFunction($input);

    public function validateClean($input)
    {
        return $this->ctypeFunction($input);
    }
}
