<?php

namespace Respect\Validation\Rules;

use ReflectionClass;
use Symfony\Component\Validator\ConstraintViolation;

class Sf extends AbstractRule
{

    public $name;
    protected $constraint;
    protected $messages = array();
    protected $validator;

    public function __construct($name, $params=array())
    {
        $this->name = ucfirst($name);
        $sfMirrorConstraint = new ReflectionClass(
                'Symfony\Component\Validator\Constraints\\' . $this->name
        );
        if ($sfMirrorConstraint->hasMethod('__construct'))
            $this->constraint = $sfMirrorConstraint->newInstanceArgs($params);
        else
            $this->constraint = $sfMirrorConstraint->newInstance();
    }

    public function assert($input)
    {
        if (!$this->validate($input)) {
            $violation = new ConstraintViolation(
                    $this->validator->getMessageTemplate(),
                    $this->validator->getMessageParameters(),
                    '',
                    '',
                    $input
            );
            throw $this->reportError($violation->getMessage());
        }
        return true;
    }

    public function validate($input)
    {
        $validatorName = 'Symfony\Component\Validator\Constraints\\'
            . $this->name . 'Validator';
        $this->validator = new $validatorName;
        return $this->validator->isValid($input, $this->constraint);
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