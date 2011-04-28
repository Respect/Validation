<?php

namespace Respect\Validation\Rules;

use ReflectionClass;

class Zend extends AbstractRule
{

    public $name;
    protected $messages = array();
    protected $zendValidator;

    public function __construct($name, $params=array())
    {
        $this->name = $name;
        $validatorName = explode('_', $name);
        $validatorName = array_map('ucfirst', $validatorName);

        try {
            $validatorClass = 'Zend_Validate_'.implode('_', $validatorName);
            $zendMirror = new ReflectionClass($validatorClass);
        } catch (\Exception $e) {
            $validatorClass = 'Zend\Validator\\'.implode('\\', $validatorName);
            $zendMirror = new ReflectionClass($validatorClass);
        }

        if ($zendMirror->hasMethod('__construct'))
            $this->zendValidator = $zendMirror->newInstanceArgs($params);
        else
            $this->zendValidator = $zendMirror->newInstance();
    }

    public function assert($input)
    {
        $exceptions = array();
        $validator = clone $this->zendValidator;
        
        if ($validator->isValid($input))
            return true;
        else
            foreach ($validator->getMessages() as $m)
                $exceptions[] = $this->reportError($m, get_object_vars($this));
        
        throw $this->reportError($input)->setRelated($exceptions);
    }

    public function validate($input)
    {
        $validator = clone $this->zendValidator;
        return $validator->isValid($input);
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