<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;

class Domain extends AbstractComposite
{

    protected $ip;
    protected $whitespace;
    protected $dot;
    protected $doubleHyphen;
    protected $start;
    protected $end;
    protected $otherParts;
    protected $domainLength;

    public function __construct()
    {
        $this->ip = new Ip();
        $this->whitespace = new NoWhitespace();
        $this->dot = new Contains('.');
        $this->doubleHyphen = new Not(new Contains('--'));
        $this->domainLength = new Length(3, null);
        $this->end = new Tld();
        $this->otherParts = new AllOf(
                new Alnum('-'),
                new Not(new StartsWith('-'))
        );
    }

    public function validate($input)
    {
        if ($this->ip->validate($input))
            return true;
        if (!$this->whitespace->validate($input)
            || !$this->dot->validate($input)
            || !$this->domainLength->validate($input))
            return false;

        $parts = explode('.', $input);
        if (count($parts) < 2)
            return false;
        if (!$this->end->validate(array_pop($parts)))
            return false;
        foreach ($parts as $p)
            if (!$this->otherParts->validate($p))
                return false;
        return true;
    }

    public function assert($input)
    {
        if ($this->ip->validate($input))
            return true;

        $e = array();

        $this->collectAssertException($e, $this->whitespace, $input);
        $this->collectAssertException($e, $this->dot, $input);
        $this->collectAssertException($e, $this->doubleHyphen, $input);
        $this->collectAssertException($e, $this->domainLength, $input);

        $parts = explode('.', $input);

        if (count($parts) >= 2)
            $this->collectAssertException($e, $this->end, array_pop($parts));
        foreach ($parts as $p)
            $this->collectAssertException($e, $this->otherParts, $p);

        if (count($e))
            throw $this->reportError($input)->setRelated($e);
        return true;
    }

    protected function collectAssertException(&$exceptions, $validator, $input)
    {
        try {
            $validator->assert($input);
        } catch (ValidationException $e) {
            $exceptions[] = $e;
        }
    }

    public function check($input)
    {
        if ($this->ip->validate($input))
            return true;
        $this->whitespace->check($input);
        $this->dot->check($input);
        $this->domainLength->check($input);
        $this->doubleHyphen->check($input);

        $parts = explode('.', $input);

        if (count($parts) >= 2)
            $this->end->check(array_pop($parts));
        foreach ($parts as $p)
            $this->otherParts->check($p);

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