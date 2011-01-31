<?php

namespace Respect\Validation\Exceptions;

abstract class AbstractRelatedException extends ValidationException
{

    public function getRelated()
    {
        if (1 === count($this->related))
            return $this->related[0]->getRelated();
        else
            return parent::getRelated();
    }

}