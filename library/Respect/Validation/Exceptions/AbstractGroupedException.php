<?php

namespace Respect\Validation\Exceptions;

class AbstractGroupedException extends AbstractNestedException
{
    const NONE = 0;
    const SOME = 1;
    public static $defaultTemplates = array(
        self::NONE => 'All of the required rules must pass for {{name}}',
        self::SOME => 'These rules must pass for {{name}}',
    );

    public function chooseTemplate()
    {
        $numRules = $this->getParam('passed');
        $numFailed = count($this->getRelated());
        return $numRules === $numFailed ? static::NONE : static::SOME;
    }

    public function getParams()
    {
        if (1 === count($this->related))
            return current($this->related)->getParams();
        else
            return parent::getParams();
    }

    public function getRelated($full=false)
    {
        if ($full || 1 !== count($this->related))
            return $this->related;
        elseif (current($this->related) instanceof AbstractNestedException)
            return current($this->related)->getRelated();
        else
            return array();
    }

    public function getTemplate()
    {
        if (1 === count($this->related))
            return current($this->related)->getTemplate();
        else
            return parent::getTemplate();
    }

}