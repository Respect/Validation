<?php

namespace Respect\Validation\Exceptions;

use \InvalidArgumentException;
use \Exception;

class ValidationException extends InvalidArgumentException
{
    const INVALID = 'Validation_1';
    public static $defaultTemplates = array(
        self::INVALID => 'Data validation failed: "%s"'
    );
    protected $messageTemplate;
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
        $this->useTemplate(
            call_user_func_array(array($this, 'chooseTemplate'), $this->params)
        );
        $this->renderMessage();
        return $this;
    }

    public function chooseTemplate()
    {
        return array_shift(array_keys(static::$defaultTemplates));
    }

    public function renderMessage()
    {
        $sprintfParams = $this->params;
        array_unshift($sprintfParams, $this->messageTemplate);
        $this->message = call_user_func_array('sprintf', $sprintfParams);
        $relatedMessages = array();
        foreach ($this->related as $n => $related) {
            $relatedMessage = "-" . $related->getMessage();
            $relatedMessage = str_replace("\n", "\n    ", $relatedMessage);
            $relatedMessages[] = $relatedMessage;
        }
        if (!empty($relatedMessages))
            $this->message .= "\n" . implode("\n", $relatedMessages);
    }

    public function setRelated(array $relatedExceptions)
    {
        foreach ($relatedExceptions as $related)
            $this->addRelated($related, false);
        $this->renderMessage();
        return $this;
    }

    public function addRelated(Exception $related, $render=true)
    {
        $this->related[] = $related;
        if ($render)
            $this->renderMessage();
        return $this;
    }

    public function useTemplate($code)
    {
        $this->messageTemplate = @static::$defaultTemplates[$code];
    }

}