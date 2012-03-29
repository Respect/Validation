<?php

namespace Respect\Validation\Exceptions;

use DateTime;
use Exception;
use InvalidArgumentException;

class ValidationException extends InvalidArgumentException
{
    const MODE_DEFAULT = 1;
    const MODE_NEGATIVE = 2;
    const STANDARD = 0;
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => 'Data validation failed for %s'
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => 'Data validation failed for %s'
        )
    );
    protected $id = 'validation';
    protected $mode = self::MODE_DEFAULT;
    protected $name = '';
    protected $template = '';
    protected $params = array();

    public static function format($template, array $vars=array())
    {
        return preg_replace_callback(
            '/{{(\w+)}}/',
            function($match) use($vars) {
                return isset($vars[$match[1]]) ? $vars[$match[1]] : $match[0];
            }, $template
        );
    }

    public static function stringify($value)
    {
        if (is_string($value))
            return $value;
        elseif (is_array($value))
            return 'Array'; //FIXME
        elseif (is_object($value))
            return static::stringifyObject($value);
        else
            return (string) $value;
    }

    public static function stringifyObject($value)
    {
        if (method_exists($value, '__toString'))
            return (string) $value;
        elseif ($value instanceof DateTime)
            return $value->format('Y-m-d H:i:s');
        else
            return "Object of class " . get_class($value);
    }

    public function __toString()
    {
        return $this->getMainMessage();
    }

    public function chooseTemplate()
    {
        return key(static::$defaultTemplates[$this->mode]);
    }

    public function configure($name, array $params = array())
    {
        $this->setName($name);
        $this->setParams($params);
        $this->message = $this->getMainMessage();
        $this->setId($this->guessId());
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMainMessage()
    {
        $vars = $this->getParams();
        $vars['name'] = $this->getName();
        $template = $this->getTemplate();
        if(isset($vars['translator']) && is_callable($vars['translator']))
            $template = call_user_func($vars['translator'], $template);
        return static::format($template, $vars);
    }

    public function getParam($name)
    {
        return $this->hasParam($name) ? $this->params[$name] : false;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getTemplate()
    {
        if (!empty($this->template))
            return $this->template;
        else
            return $this->template = $this->buildTemplate();
    }

    public function hasParam($name)
    {
        return isset($this->params[$name]);
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName($name)
    {
        $this->name = static::stringify($name);
        return $this;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
        $this->template = $this->buildTemplate();
        return $this;
    }

    public function setParam($key, $value)
    {
        $this->params[$key] = ($key == 'translator') ? $value : static::stringify($value);
        return $this;
    }

    public function setParams(array $params)
    {
        foreach ($params as $key => $value)
            $this->setParam($key, $value);
        return $this;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    protected function buildTemplate()
    {
        $templateKey = $this->chooseTemplate();
        return static::$defaultTemplates[$this->mode][$templateKey];
    }

    protected function guessId()
    {
        if (!empty($this->id) && $this->id != 'validation')
            return $this->id;
        $classParts = explode('\\', get_called_class());
        $id = end($classParts);
        $id = lcfirst(str_replace('Exception', '', $id));
        return $id;
    }

}

