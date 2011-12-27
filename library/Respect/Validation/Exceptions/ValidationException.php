<?php

namespace Respect\Validation\Exceptions;

use DateTime;
use Exception;
use InvalidArgumentException;
use Respect\Validation\Validatable;

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

/**
 * LICENSE
 *
 * Copyright (c) 2009-2011, Alexandre Gomes Gaigalas.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *
 *     * Redistributions in binary form must reproduce the above copyright notice,
 *       this list of conditions and the following disclaimer in the documentation
 *       and/or other materials provided with the distribution.
 *
 *     * Neither the name of Alexandre Gomes Gaigalas nor the names of its
 *       contributors may be used to endorse or promote products derived from this
 *       software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */