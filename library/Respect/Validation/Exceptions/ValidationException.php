<?php

namespace Respect\Validation\Exceptions;

use \InvalidArgumentException;
use \Exception;
use \RecursiveTreeIterator;
use Respect\Validation\ExceptionIterator;

class ValidationException extends InvalidArgumentException
{

    public static $defaultTemplates = array(
        'Data validation failed: "%s"'
    );
    protected $related = array();
    protected $params = array();

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

    public function getMainMessage()
    {
        $sprintfParams = $this->params;
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

    public function addRelated(Exception $related)
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