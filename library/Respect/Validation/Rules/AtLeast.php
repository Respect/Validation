<?php

namespace Respect\Validation\Rules;

class AtLeast extends AbstractComposite
{

    public $howMany = 1;

    public function __construct($howMany, $rules=array())
    {
        $this->howMany = $howMany;
        $this->addRules($rules);
    }

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        $numRules = count($validators);
        $numExceptions = count($exceptions);
        $numPassed = $numRules - $numExceptions;
        $summary = array(
            'total' => $numRules,
            'failed' => $numExceptions,
            'passed' => $numPassed
        );
        if ($this->howMany > $numPassed)
            throw $this->reportError($input, $summary)->setRelated($exceptions);
        return true;
    }

    public function check($input)
    {
        $validators = $this->getRules();
        $exceptions = array();
        $numRules = count($validators);
        $numPassed = 0;
        $maxExceptions = $numRules - $this->howMany;
        foreach ($validators as $v) {
            try {
                $v->check($input);
                if (++$numPassed >= $this->howMany)
                    return true;
                if (count($exceptions) > $maxExceptions)
                    throw $this->reportError(
                        $input,
                        array('passed' => $numPassed))->setRelated($exceptions);
            } catch (ValidationException $e) {
                $exceptions[] = $e;
            }
        }
        return false;
    }

    public function validate($input)
    {
        $validators = $this->getRules();
        $numPassed = 0;
        foreach ($validators as $v)
            try {
                $v->check($input);
                if (++$numPassed >= $this->howMany)
                    return true;
            } catch (ValidationException $e) {
                //empty catch block is nasty, i know, but no need to do
                //anything here. We just wanna count how many rules passed
            }

        return false;
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