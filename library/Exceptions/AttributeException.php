<?php
namespace Respect\Validation\Exceptions;

class AttributeException extends AbstractNestedException
{
    const NOT_PRESENT = 0;
    const INVALID = 1;

    public function chooseTemplate()
    {
        return $this->getParam('hasReference') ? static::INVALID : static::NOT_PRESENT;
    }
}
