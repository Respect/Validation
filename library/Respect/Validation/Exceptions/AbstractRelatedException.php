<?php

namespace Respect\Validation\Exceptions;

class AbstractRelatedException extends AbstractCompositeException
{
    public function getMainMessage()
    {
        $vars = $this->getParams();
        $vars['name'] = $this->getName();
        return static::format($this->getTemplate(), $vars);
    }

    public function getRelated($full=false)
    {
        return $this->related;
    }
    
    public function chooseTemplate()
    {
        return 0;
    }

}
