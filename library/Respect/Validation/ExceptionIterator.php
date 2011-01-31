<?php

namespace Respect\Validation;

use \RecursiveArrayIterator;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Exceptions\AbstractCompositeException;

class ExceptionIterator extends RecursiveArrayIterator
{

    public function __construct($target)
    {
        parent::__construct(is_array($target) ? $target : array($target));
    }

    public function hasChildren()
    {
        return (bool) $this->current()->getRelated();
    }

    public function getChildren()
    {
        return new static($this->current()->getRelated());
    }

}