<?php

namespace Respect\Validation\Exceptions;

class AbstractCompositeException extends AbstractRelatedException
{

    public static $defaultTemplates = array(
        'None of the rules passed',
        '%2$d rules did not passed',
    );

    public function chooseTemplate($input, $numFailed, $numRequired, $numTotal)
    {
        return $numFailed === $numTotal ? 0 : 1;
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