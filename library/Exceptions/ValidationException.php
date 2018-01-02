<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Exceptions;

use DateTime;
use Exception;
use InvalidArgumentException;
use Traversable;

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

    /**
     * @var int
     */
    private static $maxDepthStringify = 5;

    /**
     * @var int
     */
    private static $maxCountStringify = 10;

    /**
     * @var string
     */
    private static $maxReplacementStringify = '...';

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
     * @param int   $depth
     *
     * @return string
     */
    public static function stringify($value, $depth = 1)
    {
        if ($depth >= self::$maxDepthStringify) {
            return self::$maxReplacementStringify;
        }

        if (is_array($value)) {
            return static::stringifyArray($value, $depth);
        }

        if (is_object($value)) {
            return static::stringifyObject($value, $depth);
        }

        if (is_resource($value)) {
            return sprintf('`[resource] (%s)`', get_resource_type($value));
        }

        if (is_float($value)) {
            if (is_infinite($value)) {
                return ($value > 0 ? '' : '-').'INF';
            }

            if (is_nan($value)) {
                return 'NaN';
            }
        }

        return (@json_encode($value, (JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)) ?: $value);
    }

    /**
     * @param array $value
     * @param int   $depth
     *
     * @return string
     */
    public static function stringifyArray(array $value, $depth = 1)
    {
        $nextDepth = ($depth + 1);
        if ($nextDepth >= self::$maxDepthStringify) {
            return self::$maxReplacementStringify;
        }

        if (empty($value)) {
            return '{ }';
        }

        $total = count($value);
        $string = '';
        $current = 0;
        foreach ($value as $childKey => $childValue) {
            if ($current++ >= self::$maxCountStringify) {
                $string .= self::$maxReplacementStringify;
                break;
            }

            if (!is_int($childKey)) {
                $string .= sprintf('%s: ', static::stringify($childKey, $nextDepth));
            }

            $string .= static::stringify($childValue, $nextDepth);

            if ($current !== $total) {
                $string .= ', ';
            }
        }

        return sprintf('{ %s }', $string);
    }

    /**
     * @param mixed $value
     * @param int   $depth
     *
     * @return string
     */
    public static function stringifyObject($value, $depth = 2)
    {
        $nextDepth = $depth + 1;

        if ($value instanceof DateTime) {
            return sprintf('"%s"', $value->format('Y-m-d H:i:s'));
        }

        $class = get_class($value);

        if ($value instanceof Traversable) {
            return sprintf('`[traversable] (%s: %s)`', $class, static::stringify(iterator_to_array($value), $nextDepth));
        }

        if ($value instanceof Exception) {
            $properties = [
                'message' => $value->getMessage(),
                'code' => $value->getCode(),
                'file' => $value->getFile().':'.$value->getLine(),
            ];

            return sprintf('`[exception] (%s: %s)`', $class, static::stringify($properties, $nextDepth));
        }

        if (method_exists($value, '__toString')) {
            return static::stringify($value->__toString(), $nextDepth);
        }

        $properties = static::stringify(get_object_vars($value), $nextDepth);

        return sprintf('`[object] (%s: %s)`', $class, str_replace('`', '', $properties));
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
        } else {
            return $this->template = $this->buildTemplate();
        }
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
        return (true === $this->customTemplate);
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

    private function buildMessage()
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
        if (!empty($this->id) && $this->id != 'validation') {
            return $this->id;
        }

        $pieces = explode('\\', get_called_class());
        $exceptionClassShortName = end($pieces);
        $ruleClassShortName = str_replace('Exception', '', $exceptionClassShortName);
        $ruleName = lcfirst($ruleClassShortName);

        return $ruleName;
    }
}
