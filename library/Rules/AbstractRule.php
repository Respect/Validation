<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractRule implements Validatable
{
    protected $name;
    protected $template = null;

    public static $translator = null;

    public function __construct()
    {
        //a constructor is required for ReflectionClass::newInstance()
    }

    public function __invoke($input)
    {
        return $this->validate($input);
    }

    public function addOr()
    {
        $rules = func_get_args();
        array_unshift($rules, $this);

        return new OneOf($rules);
    }

    public function assert($input)
    {
        if ($this->__invoke($input)) {
            return true;
        }
        throw $this->reportError($input);
    }

    public function check($input)
    {
        return $this->assert($input);
    }

    public function getName()
    {
        return $this->name;
    }

    public function reportError($input, array $extraParams = array())
    {
        $exception = $this->createException();
        $name = $this->name ?: ValidationException::stringify($input);
        $params = array_merge(
            get_class_vars(__CLASS__),
            get_object_vars($this),
            $extraParams,
            compact('input')
        );
        $exception->configure($name, $params);
        if (!is_null($this->template)) {
            $exception->setTemplate($this->template);
        }

        return $exception;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    protected function createException()
    {
        $currentFQN = get_called_class();
        $exceptionFQN = str_replace('\\Rules\\', '\\Exceptions\\', $currentFQN);
        $exceptionFQN .= 'Exception';

        return new $exceptionFQN();
    }
}
