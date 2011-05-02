<?php

namespace Respect\Validation\Exceptions;

use RecursiveIteratorIterator;
use RecursiveTreeIterator;
use Respect\Validation\ExceptionIterator;

class AbstractNestedException extends ValidationException
{
    const ITERATE_TREE = 1;
    const ITERATE_ALL = 2;

    protected $related = array();

    public function addRelated(ValidationException $related)
    {
        $this->related[spl_object_hash($related)] = $related;
        return $this;
    }

    public function findMessages(array $paths)
    {
        $messages = array();

        foreach ($paths as $key => $value) {
            $numericKey = is_numeric($key);
            $path = $numericKey ? $value : $key;

            $e = $this->findRelated($path);

            if (is_object($e) && !$numericKey)
                $e->setTemplate($value);

            $path = str_replace('.', '_', $path);
            $messages[$path] = $e ? $e->getMainMessage() : '';
        }
        return $messages;
    }

    public function findRelated($path)
    {
        $target = $this;
        $path = explode('.', $path);

        while (!empty($path) && $target !== false)
            $target = $target->getRelatedByName(array_shift($path));
        return $target;
    }

    public function getIterator($full=false, $mode=self::ITERATE_ALL)
    {
        $exceptionIterator = new ExceptionIterator($this, $full);

        if ($mode == self::ITERATE_ALL)
            return new RecursiveIteratorIterator($exceptionIterator, 1);
        else
            return new RecursiveTreeIterator($exceptionIterator);
    }

    public function getFullMessage()
    {
        $message = array();

        foreach ($this->getIterator(false, self::ITERATE_TREE) as $m)
            $message[] = $m;
        return implode(PHP_EOL, $message);
    }

    public function getRelated($full=false)
    {
        return $this->related;
    }

    public function getRelatedByName($name)
    {
        foreach ($this->getIterator(true) as $e)
            if ($e->getId() === $name || $e->getName() === $name)
                return $e;

        return false;
    }

    public function setRelated(array $relatedExceptions)
    {
        foreach ($relatedExceptions as $related)
            $this->addRelated($related);

        return $this;
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