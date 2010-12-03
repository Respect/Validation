<?php

namespace Respect\Validation\Exceptions;

use \InvalidArgumentException;

class ValidationException extends InvalidArgumentException
{
    const INVALID = 'Validation_1';
    public static $defaultTemplates = array(
        self::INVALID => 'Data validation failed: "%s"'
    );
    protected $messageTemplate;
    protected $related = array();
    protected $params = array();

    public function configure()
    {
        $this->params = array_map(
            function($mixed) {
                return is_object($mixed) ? get_class($mixed) : strval($mixed);
            }, func_get_args()
        );
        $this->useTemplate($this->chooseTemplate($this->params));
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
    }

    public function useTemplate($code)
    {
        $this->messageTemplate = @static::$defaultTemplates[$code];
    }

    public function useParams($params)
    {
        
    }

}