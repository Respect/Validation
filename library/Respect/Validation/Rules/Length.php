<?php

namespace Respect\Validation\Rules;

use Countable;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Validator;

class Length extends AbstractRule
{

    public $minValue;
    public $maxValue;
    public $inclusive;

    public function __construct($min=null, $max=null, $inclusive=true)
    {
        $this->minValue = $min;
        $this->maxValue = $max;
        $this->inclusive = $inclusive;
        $paramValidator = new OneOf(new Numeric, new NullValue);
        if (!$paramValidator->validate($min))
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $min)
            );

        if (!$paramValidator->validate($max))
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $max)
            );

        if (!is_null($min) && !is_null($max) && $min > $max) {
            throw new ComponentException(
                sprintf('%s cannot be less than %s for validation', $min, $max)
            );
        }
    }

    public function validate($input)
    {
        $length = $this->extractLength($input);
        return $this->validateMin($length) && $this->validateMax($length);
    }

    protected function extractLength($input)
    {
        if (is_string($input))
            return mb_strlen($input);
        elseif (is_array($input) || $input instanceof Countable)
            return count($input);
        elseif (is_object($input))
            return count(get_object_vars($input));
        else
            return false;
    }

    protected function validateMin($length)
    {
        if (is_null($this->minValue))
            return true;

        if ($this->inclusive)
            return $length >= $this->minValue;

        return $length > $this->minValue;
    }

    protected function validateMax($length)
    {
        if (is_null($this->maxValue)) {
            return true;
        }

        if ($this->inclusive) {
            return $length <= $this->maxValue;
        }

        return $length < $this->maxValue;
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
