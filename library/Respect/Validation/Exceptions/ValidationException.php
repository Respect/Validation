<?php

namespace Respect\Validation\Exceptions;

use \InvalidArgumentException;
use \Exception;
use \RecursiveIteratorIterator;
use \RecursiveTreeIterator;
use Respect\Validation\ExceptionIterator;
use Respect\Validation\Reportable;

class ValidationException extends InvalidArgumentException
{
    const ITERATE_TREE = 1;
    const ITERATE_ALL = 2;
    public static $defaultTemplates = array(
        'Data validation failed: "%s"'
    );
    protected $related = array();
    protected $params = array();
    protected $name = '';

    public static function create()
    {
        $instance = new static;
        return func_num_args() > 0 ? $instance : $instance->configure(func_get_args());
    }

    public function configure()
    {
        $this->message = $this->getMainMessage();
        $this->params = func_get_args();
        $this->stringifyParams();
        $this->guessName();
        return $this;
    }

    protected function guessName()
    {
        if (!empty($this->name))
            return;
        $name = end(explode('\\', get_called_class()));
        $name = lcfirst(str_replace('Exception', '', $name));
        $this->setName($name);
    }

    protected function stringifyParams()
    {
        foreach ($this->params as &$param)
            if (!is_object($param) || method_exists($param, '__toString'))
                $param = (string) $param;
            else
                $param = get_class($param);
    }

    public function chooseTemplate()
    {
        return key(static::$defaultTemplates);
    }

    public function getFullMessage()
    {
        $message = array();
        foreach ($this->iterate(false, self::ITERATE_TREE) as $m)
            $message[] = $m;
        return implode(PHP_EOL, $message);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRelatedByName($name)
    {
        foreach ($this->iterate(true) as $e)
            if ($e->getName() === $name)
                return $e;
        return false;
    }

    public function iterate($full=false, $mode=self::ITERATE_ALL)
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

    public function getMainMessage()
    {
        $sprintfParams = $this->params;
        if (empty($sprintfParams))
            return $this->message;
        array_unshift($sprintfParams, $this->getTemplate());
        return call_user_func_array('sprintf', $sprintfParams);
    }

    public function getRelated()
    {
        return $this->related;
    }

    public function setRelated(array $relatedExceptions)
    {
        foreach ($relatedExceptions as $related)
            $this->addRelated($related);
        return $this;
    }

    public function addRelated(ValidationException $related)
    {
        $this->related[] = $related;
        return $this;
    }

    public function getTemplate()
    {
        $templateKey = call_user_func_array(
            array($this, 'chooseTemplate'), $this->params
        );
        return static::$defaultTemplates[$templateKey];
    }

    public function __toString()
    {
        return $this->getMainMessage();
    }

}