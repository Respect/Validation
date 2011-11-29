<?php

namespace Respect\Validation\Rules;

use Traversable;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

class Each extends AbstractRule
{

    public $itemValidator;
    public $keyValidator;

    public function __construct(Validatable $itemValidator = null,
                                Validatable $keyValidator=null)
    {
        $this->itemValidator = $itemValidator;
        $this->keyValidator = $keyValidator;
    }

    public function assert($input)
    {
        $exceptions = array();

        if (!is_array($input) || $input instanceof Traversable)
            throw $this->reportError($input);

        if (empty($input))
            return true;

        foreach ($input as $key => $item) {
            if (isset($this->itemValidator))
                try {
                    $this->itemValidator->assert($item);
                } catch (ValidationException $e) {
                    $exceptions[] = $e;
                } 
            if (isset($this->keyValidator))
                try {
                    $this->keyValidator->assert($key);
                } catch (ValidationException $e) {
                    $exceptions[] = $e;
                }
        }

        if (!empty($exceptions))
            throw $this->reportError($input)->setRelated($exceptions);

        return true;
    }

    public function check($input)
    {
        if (empty($input))
            return true;

        if (!is_array($input) || $input instanceof Traversable)
            throw $this->reportError($input);

        foreach ($input as $key => $item) {
            if (isset($this->itemValidator))
                $this->itemValidator->check($item);
            if (isset($this->keyValidator))
                $this->keyValidator->check($key);
        }

        return true;
    }

    public function validate($input)
    {
        if (!is_array($input) || $input instanceof Traversable)
            return false;
        
        if (empty($input))
            return true;

        foreach ($input as $key => $item) {
            if (isset($this->itemValidator) && !$this->itemValidator->validate($item))
                return false;
            if (isset($this->keyValidator) && !$this->keyValidator->validate($key))
                return false;
        }

        return true;
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