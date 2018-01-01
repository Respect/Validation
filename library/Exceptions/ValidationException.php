<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use function in_array;
use function is_numeric;
use function Respect\Stringifier\stringify;
use InvalidArgumentException;

class ValidationException extends InvalidArgumentException implements ExceptionInterface
{
    const MODE_DEFAULT = 1;
    const MODE_NEGATIVE = 2;
    const STANDARD = 0;
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Data validation failed for %s',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Data validation failed for %s',
        ],
    ];

    protected $id = 'validation';
    protected $mode = self::MODE_DEFAULT;
    protected $name = '';
    protected $template = '';
    protected $params = [];
    private $customTemplate = false;

    public static function format($template, array $vars = [])
    {
        return preg_replace_callback(
            '/{{(\w+)}}/',
            function ($match) use ($vars) {
                if (!isset($vars[$match[1]])) {
                    return $match[0];
                }

                $value = $vars[$match[1]];
                if ('name' == $match[1] && is_string($value)) {
                    return $value;
                }

                return ValidationException::stringify($value);
            },
            $template
        );
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public static function stringify($value)
    {
        return stringify($value);
    }

    public function __toString()
    {
        return $this->getMainMessage();
    }

    public function chooseTemplate()
    {
        return key(static::$defaultTemplates[$this->mode]);
    }

    public function configure($name, array $params = [])
    {
        $this->setName($name);
        $this->setId($this->guessId());
        $this->setParams($params);

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    protected function hasName(): bool
    {
        $name = $this->getName();
        if (is_numeric($name)) {
            return (bool) (float) $name;
        }

        return !in_array($name, ['`FALSE`', '`NULL`', '`{ }`', '""', '']);
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
        if (isset($vars['translator']) && is_callable($vars['translator'])) {
            $template = call_user_func($vars['translator'], $template);
        }

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
        if (!empty($this->template)) {
            return $this->template;
        }

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
        $this->name = $name;

        return $this;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
        $this->template = $this->buildTemplate();

        $this->buildMessage();

        return $this;
    }

    public function setParam($key, $value)
    {
        $this->params[$key] = $value;

        $this->buildMessage();

        return $this;
    }

    public function setParams(array $params)
    {
        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }

        $this->buildMessage();

        return $this;
    }

    public function hasCustomTemplate()
    {
        return true === $this->customTemplate;
    }

    public function setTemplate($template)
    {
        $this->customTemplate = true;
        if (isset(static::$defaultTemplates[$this->mode][$template])) {
            $template = static::$defaultTemplates[$this->mode][$template];
        }
        $this->template = $template;

        $this->buildMessage();

        return $this;
    }

    private function buildMessage(): void
    {
        $this->message = $this->getMainMessage();
    }

    protected function buildTemplate()
    {
        $templateKey = $this->chooseTemplate();

        return static::$defaultTemplates[$this->mode][$templateKey];
    }

    public function guessId()
    {
        if (!empty($this->id) && 'validation' != $this->id) {
            return $this->id;
        }

        $pieces = explode('\\', get_called_class());
        $exceptionClassShortName = end($pieces);
        $ruleClassShortName = str_replace('Exception', '', $exceptionClassShortName);
        $ruleName = lcfirst($ruleClassShortName);

        return $ruleName;
    }
}
