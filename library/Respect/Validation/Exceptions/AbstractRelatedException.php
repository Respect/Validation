<?php

namespace Respect\Validation\Exceptions;

abstract class AbstractRelatedException extends ValidationException
{

    public function getRelated($full=false)
    {
        if (!$full && 1 === count($this->related))
            return $this->related[0]->getRelated(true);
        else
            return parent::getRelated($full);
    }

}