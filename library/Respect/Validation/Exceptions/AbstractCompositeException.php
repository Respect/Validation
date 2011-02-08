<?php

namespace Respect\Validation\Exceptions;

class AbstractCompositeException extends AbstractRelatedException
{
    const NONE = 0;
    const SOME = 1;
    public static $defaultTemplates = array(
        self::NONE => 'All of the %3$d required rules must pass for %1$s',
        self::SOME => 'These %2$d rules must pass for %1$s',
    );

    public function chooseTemplate($name, $numFailed, $numRequired, $numTotal)
    {
        return $numFailed === $numTotal ? static::NONE : static::SOME;
    }

    public function getMainMessage()
    {
        if (1 === count($this->related))
            return $this->related[0]
                ->setName($this->getName())
                ->getMainMessage();
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