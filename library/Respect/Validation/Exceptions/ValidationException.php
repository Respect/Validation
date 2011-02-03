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

    public static $defaultTemplates = array(
        'Data validation failed: "%s"'
    );
    protected $related = array();
    protected $params = array();
    protected $name = '';

    public static function create()
    {
        $instance = new static;
        $params = func_get_args();
        if (!empty($params))
            $instance->configure($params);
        return $instance;
    }

    public function configure()
    {
        $this->params = array_map(
            function($mixed) {
                return is_object($mixed) ? get_class($mixed) : strval($mixed);
            }, func_get_args()
        );
        $this->message = $this->getMainMessage();
        if (empty($this->name)) {
            $name = end(explode('\\', get_called_class()));
            $name = lcfirst(str_replace('Exception', '', $name));
            $this->setName($name);
        }
        return $this;
    }

    public function chooseTemplate()
    {
        return array_shift(array_keys(static::$defaultTemplates));
    }

    public function getFullMessage()
    {
        $message = array();
        foreach (new RecursiveTreeIterator(new ExceptionIterator($this)) as $m)
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
        $iter = new RecursiveIteratorIterator(
                new ExceptionIterator($this, true),
                RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iter as $e)
            if ($e->getName() === $name)
                return $e;
        return false;
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