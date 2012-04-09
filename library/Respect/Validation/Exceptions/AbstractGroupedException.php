<?php

namespace Respect\Validation\Exceptions;

class AbstractGroupedException extends AbstractNestedException
{
    const NONE = 0;
    const SOME = 1;
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::NONE => 'All of the required rules must pass for {{name}}',
            self::SOME => 'These rules must pass for {{name}}',
        ),
        self::MODE_NEGATIVE => array(
            self::NONE => 'None of there rules must pass for {{name}}',
            self::SOME => 'These rules must not pass for {{name}}',
        )
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
        if (!$full && 1 === count($this->related) 
            && current($this->related) instanceof AbstractNestedException)
            return current($this->related)->getRelated();
        else
            return $this->related;
    }

    public function getTemplate()
    {
        $parentTemplate = parent::getTemplate();
        $isEmpty = empty($this->template);

        if (!$isEmpty && $this->template != $parentTemplate)
            return $this->template;
        if ($isEmpty && 1 === count($this->related))
            return current($this->related)->getTemplate();
        else
            return $parentTemplate;
    }
}