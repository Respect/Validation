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

    public function findMessages(array $paths)
    {
        $messages = array();

        foreach ($paths as $key => $value) {
            $numericKey = is_numeric($key);
            $path = $numericKey ? $value : $key;

            $e = $this->findRelated($path);

            if (is_object($e) && !$numericKey) {
                $e->setTemplate($value);
            }

            $path = str_replace('.', '_', $path);
            $messages[$path] = $e ? $e->getMainMessage() : '';
        }

        return $messages;
    }

    public function findRelated($path)
    {
        $target = $this;
        $path = explode('.', $path);

        while (!empty($path) && $target !== false) {
            $target = $target->getRelatedByName(array_shift($path));
        }

        return $target;
    }

    public function getIterator($full=false, $mode=self::ITERATE_ALL)
    {
        $exceptionIterator = new ExceptionIterator($this, $full);

        if ($mode == self::ITERATE_ALL) {
            return new RecursiveIteratorIterator($exceptionIterator, 1);
        } else {
            return new RecursiveTreeIterator($exceptionIterator);
        }
    }

    public function getFullMessage()
    {
        $message = array();
        $iterator = $this->getIterator(false, self::ITERATE_TREE);
        foreach ($iterator as $m) {
            $message[] = $m;
        }

        return implode(PHP_EOL, $message);
    }

    public function getRelated($full=false)
    {
        if (!$full && 1 === count($this->related)
            && current($this->related) instanceof AbstractNestedException) {
            return current($this->related)->getRelated();
        } else {
            return $this->related;
        }
    }

    public function getRelatedByName($name)
    {
        foreach ($this->getIterator(true) as $e) {
            if ($e->getId() === $name || $e->getName() === $name) {
                return $e;
            }
        }

        return false;
    }

    public function setRelated(array $relatedExceptions)
    {
        foreach ($relatedExceptions as $related) {
            $this->addRelated($related);
        }

        return $this;
    }
}

