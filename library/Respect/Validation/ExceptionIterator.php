<?php

namespace Respect\Validation;

use RecursiveArrayIterator;
use Respect\Validation\Exceptions\AbstractNestedException;

class ExceptionIterator extends RecursiveArrayIterator
{

    protected $fullRelated;

    public function __construct($target, $fullRelated = false)
    {
        $this->fullRelated = $fullRelated;
        parent::__construct(is_array($target) ? $target : array($target));
    }

    public function hasChildren()
    {
        if (!$this->current() instanceof AbstractNestedException)
            return false;
        else
            return (boolean) $this->current()->getRelated($this->fullRelated);
    }

    public function getChildren()
    {
        return new static($this->current()->getRelated($this->fullRelated), $this->fullRelated);
    }

}

