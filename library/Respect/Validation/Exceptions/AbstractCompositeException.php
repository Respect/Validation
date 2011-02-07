<?php

namespace Respect\Validation\Exceptions;

class AbstractCompositeException extends AbstractRelatedException
{
    const NONE = 0;
    const SOME = 1;
    public static $defaultTemplates = array(
        self::NONE => 'None of the rules passed',
        self::SOME => '%2$d rules did not passed',
    );

    public function chooseTemplate($input, $numFailed, $numRequired, $numTotal)
    {
        return $numFailed === $numTotal ? static::NONE : static::SOME;
    }

    public function getMainMessage()
    {
        if (1 === count($this->related))
            return $this->related[0]->getMainMessage();
        else
            return parent::getMainMessage();
    }

    public function getRelated($full=false)
    {
        if (!$full && 1 === count($this->related))
            return $this->related[0]->getRelated(false);
        else
            return parent::getRelated($full);
    }

}