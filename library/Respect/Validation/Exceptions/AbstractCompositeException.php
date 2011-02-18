<?php

namespace Respect\Validation\Exceptions;

use RecursiveIteratorIterator;
use RecursiveTreeIterator;
use Respect\Validation\ExceptionIterator;

class AbstractCompositeException extends ValidationException
{
    const ITERATE_TREE = 1;
    const ITERATE_ALL = 2;
    const NONE = 0;
    const SOME = 1;
    protected $related = array();
    public static $defaultTemplates = array(
        self::NONE => 'All of the required rules must pass for {{name}}',
        self::SOME => 'These rules must pass for {{name}}',
    );

    public function chooseTemplate()
    {
        $numRules = $this->getParam('passed');
        $numFailed = count($this->getRelated());
        return $numRules === $numFailed ? static::NONE : static::SOME;
    }

    public function getFullMessage()
    {
        $message = array();
        foreach ($this->getIterator(false, self::ITERATE_TREE) as $m)
            $message[] = $m;
        return implode(PHP_EOL, $message);
    }

    public function setContext($context)
    {
        parent::setContext($context);
        foreach ($this->related as $r)
            $r->setContext($context);
    }

    public function getIterator($full=false, $mode=self::ITERATE_ALL)
    {
        $exceptionIterator = new ExceptionIterator($this, $full);
        if ($mode == self::ITERATE_ALL)
            return new RecursiveIteratorIterator($exceptionIterator, 1);
        else
            return new RecursiveTreeIterator($exceptionIterator);
    }

    public function findRelated()
    {
        $target = $this;
        $path = func_get_args();
        while (!empty($path) && $target !== false)
            $target = $this->getRelatedByName(array_shift($path));
        return $target;
    }

    public function getRelatedByName($name)
    {
        foreach ($this->getIterator(true) as $e) {
            if ($e->getId() === $name || $e->getName() === $name)
                return $e;
        }
        return false;
    }

    public function addRelated(ValidationException $related)
    {
        if ($related instanceof static)
            $related->setName($this->getName());
        $this->related[] = $related;
        return $this;
    }

    public function setName($name)
    {
        foreach ($this->related as $r)
            if ($r instanceof static)
                $r->setName($name);
        return parent::setName($name);
    }

    public function setRelated(array $relatedExceptions)
    {
        foreach ($relatedExceptions as $related)
            $this->addRelated($related);
        return $this;
    }

    public function getRelated($full=false)
    {
        if ($full || 1 !== count($this->related))
            return $this->related;
        elseif ($this->related[0] instanceof self)
            return $this->related[0]->getRelated();
        else
            return array();
    }

    public function getMainMessage()
    {
        if (1 === count($this->related) &&
            ($this->related[0] instanceof static
            || !$this->related[0] instanceof self ))
            return $this->related[0]->getMainMessage();
        else
            return parent::getMainMessage();
    }

}
