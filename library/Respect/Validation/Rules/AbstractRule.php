<?php

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

    public function assert($input)
    {
        if ($this->validate($input))
            return true;
        else
            throw $this->reportError($input);
    }

    public function check($input)
    {
        return $this->assert($input);
    }

    public function filter($input)
    {
        return $this->validate($input) ? $input : null;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function reportError($input, array $extraParams=array())
    {
        $exception = $this->createException();
        $input = ValidationException::stringify($input);
        $name = $this->getName() ? : "\"$input\"";
        $params = array_merge(
            $extraParams, get_object_vars($this), get_class_vars(__CLASS__),
            compact('input')
        );
        $exception->configure($name, $params);
        if (!is_null($this->template))
            $exception->setTemplate($this->template);
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
        return new $exceptionFQN;
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