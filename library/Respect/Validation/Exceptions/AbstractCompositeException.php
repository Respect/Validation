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
        if ($numFailed === $numTotal)
            return 0;
        else
            return 1;
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
            return $this->related[0]->getRelated();
        else
            return parent::getRelated($full);
    }

}