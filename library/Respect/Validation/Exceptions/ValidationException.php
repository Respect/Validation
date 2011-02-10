<?php

namespace Respect\Validation\Exceptions;

use DateTime;
use Exception;
use InvalidArgumentException;
use Respect\Validation\Validatable;

class ValidationException extends InvalidArgumentException
{
    const STANDARD = 0;
    const ITERATE_TREE = 1;
    const ITERATE_ALL = 2;
    public static $defaultTemplates = array(
        self::STANDARD => 'Data validation failed for %s'
    );
    protected $context = null;
    protected $id = '';
    protected $name = 'validation';
    protected $template = '';
    protected $validator = null;

    public static function format($template, array $vars=array())
    {
        return preg_replace_callback(
            '/{{(\w+)}}/',
            function($match) use($vars) {
                return $vars[$match[1]];
            }, $template
        );
    }

    public static function stringify($value)
    {
        if (is_string($value))
            return $value;
        elseif (is_object($value))
            if (method_exists($value, '__toString'))
                return (string) $value;
            elseif ($value instanceof DateTime)
                return $value->format('Y-m-d H:i:s');
            else
                return "Object of class " . get_class($value);
        else
            return (string) $value;
    }

    public function __toString()
    {
        return $this->getMainMessage();
    }

    public function chooseTemplate()
    {
        return key(static::$defaultTemplates);
    }

    public function configure($name, array $params = array())
    {
        $this->setName($name);
        $this->setParams($params);
        $this->message = $this->getMainMessage();
        $this->guessId();
        return $this;
    }


    public function getFullMessage()
    {
        $message = array();
        foreach ($this->getIterator(false, self::ITERATE_TREE) as $m)
            $message[] = $m;
        return implode(PHP_EOL, $message);
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
        return static::format($this->getTemplate(), $vars);
    }

    public function getParam($name)
    {
        return $this->hasParam($name) ? $this->params[$name] : false;
    }

    public function hasParam($name)
    {
        return isset($this->params[$name]);
    }

    public function getParams()
    {
        return $this->params;
    }


    public function getTemplate()
    {
        if (!empty($this->template))
            return $this->template;
        $templateKey = $this->chooseTemplate();
        if (is_null($this->context))
            $this->template = static::$defaultTemplates[$templateKey];
        else
            $this->template = $this->context->getTemplate($this, $templateKey);
        return $this->template;
    }

    public function setContext($context)
    {
        $this->context = $context;
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

    public function setParams(array $params)
    {
        $this->params = array_map(array(get_called_class(), 'stringify'),
            $params);
    }


    public function setTemplate($template)
    {
        $this->template = $template;
    }

    protected function guessId()
    {
        if (!empty($this->id))
            return;
        $id = end(explode('\\', get_called_class()));
        $id = lcfirst(str_replace('Exception', '', $id));
        $this->setId($id);
    }

}
