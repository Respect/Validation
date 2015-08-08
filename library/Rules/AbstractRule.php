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

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\RequiredValidatable;
use Respect\Validation\Validatable;

abstract class AbstractRule implements Validatable
{
    protected $name;
    protected $template = null;

    public static $translator = null;

    public function __construct()
    {
        //a constructor is required for ReflectionClass::newInstance()
    }

    /**
     * Should perform the validation on child classes.
     *
     * This method is called by `validate()` right after checking if the value
     * is optional or not.
     *
     * @param mixed $input
     *
     * @return bool
     */
    abstract protected function validateConcrete($input);

    /**
     * Returns if a given value is optional or not.
     *
     * @param mixed $input
     *
     * @return bool
     */
    protected function isOptional($input)
    {
        if ($this instanceof RequiredValidatable) {
            return false;
        }

        return ($input === '');
    }

    /**
     * {@inheritdoc}
     */
    final public function validate($input)
    {
        return $this->isOptional($input) || $this->validateConcrete($input);
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
        $input = ValidationException::stringify($input);
        $name = $this->name ?: "\"$input\"";
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
