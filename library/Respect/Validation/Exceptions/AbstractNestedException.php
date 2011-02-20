<?php

namespace Respect\Validation\Exceptions;

use RecursiveIteratorIterator;
use RecursiveTreeIterator;
use Respect\Validation\ExceptionIterator;

class AbstractNestedException extends ValidationException
{
    const ITERATE_TREE = 1;
    const ITERATE_ALL = 2;

    protected $related = array();

    public function addRelated(ValidationException $related)
    {
        $this->related[spl_object_hash($related)] = $related;
        return $this;
    }

    public function findRelated()
    {
        $target = $this;
        $path = func_get_args();

        while (!empty($path) && $target !== false)
            $target = $this->getRelatedByName(array_shift($path));
        return $target;
    }

    public function getIterator($full=false, $mode=self::ITERATE_ALL)
    {
        $exceptionIterator = new ExceptionIterator($this, $full);

        if ($mode == self::ITERATE_ALL)
            return new RecursiveIteratorIterator($exceptionIterator, 1);
        else
            return new RecursiveTreeIterator($exceptionIterator);
    }

    public function getFullMessage()
    {
        $message = array();

        foreach ($this->getIterator(false, self::ITERATE_TREE) as $m)
            $message[] = $m;
        return implode(PHP_EOL, $message);
    }

    public function getRelated($full=false)
    {
        return $this->related;
    }

    public function getRelatedByName($name)
    {
        foreach ($this->getIterator(true) as $e)
            if ($e->getId() === $name || $e->getName() === $name)
                return $e;

        return false;
    }

    public function setContext($context)
    {
        parent::setContext($context);

        foreach ($this->related as $r)
            $r->setContext($context);
    }

    public function setRelated(array $relatedExceptions)
    {
        foreach ($relatedExceptions as $related)
            $this->addRelated($related);

        return $this;
    }

}
