<?php

namespace Respect\Validation\Exceptions;

class AbstractRelatedException extends AbstractCompositeException
{

    public function chooseTemplate()
    {
        return 0;
    }

    public function getMainMessage()
    {
        $vars = $this->getParams();
        $vars['name'] = $this->getName();
        return static::format($this->getTemplate(), $vars);
    }

    public function getRelated()
    {
        return $this->related;
    }

}
