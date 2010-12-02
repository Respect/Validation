<?php

namespace Respect\Validation\Exceptions;

use \InvalidArgumentException;

class ValidationException extends InvalidArgumentException
{
    const INVALID = 'Validation_1';
    public static $defaultTemplates = array(
        self::INVALID => 'Data validation failed'
    );
    protected $messageTemplate = 'Data validation failed';
    protected $related = array();
    protected $params = array();

    public function __construct($code=null)
    {
        if (!is_null($code))
            $this->setMessageTemplateFromCode($code);
    }

    public function getMessageTemplate()
    {
        return $this->messageTemplate;
    }

    public function setMessageTemplate($messageTemplate)
    {
        $this->messageTemplate = $messageTemplate;
        return $this;
    }

    public function setMessageTemplateFromCode($code)
    {
        $this->setMessageTemplate($this->getTemplate($code));
        return $this;
    }

    public function getTemplate($code)
    {
        return @static::$defaultTemplates[$code];
    }

    public function setParams()
    {
        $messageParameters = func_get_args();
        foreach ($messageParameters as &$par)
            $par = static::stringify($par);
        $this->params = $messageParameters;
        $this->renderMessage();
        return $this;
    }

    public function setRelated(array $relatedExceptions)
    {
        foreach ($relatedExceptions as $e)
            $this->addRelated($e, false);
        $this->renderMessage();
        return $this;
    }

    public function getRelated()
    {
        return $this->related;
    }

    public function addRelated(ValidationException $relatedException,
        $render=true)
    {
        $this->related[] = $relatedException;
        if ($render)
            $this->renderMessage();
        return $this;
    }

    protected function renderMessage()
    {
        $relatedMessages = array();
        $params = $this->params;
        array_unshift($params, $this->messageTemplate);
        $this->message = @call_user_func_array('sprintf', $params);
        foreach ($this->related as $n => $related) {
            $relatedMessage = "-" . $related->getMessage();
            $relatedMessage = str_replace("\n", "\n    ", $relatedMessage);
            $relatedMessages[] = $relatedMessage;
        }
        if (!empty($relatedMessages))
            $this->message .= "\n" . implode("\n", $relatedMessages);
    }

    protected static function stringify($mixed)
    {
        if (is_object($mixed))
            return get_class($mixed);
        else
            return strval($mixed);
    }

}