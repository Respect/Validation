<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Singwai Chan<c.singwai@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

class SuperSet extends AbstractRule
{

    public $compareTo;

    /**
     * SuperSet constructor.
     * @param $compareTo
     */
    public function __construct($compareTo)
    {
        $this->compareTo = $compareTo;
    }

    public function validate($input)
    {
        return !array_diff($input, $this->compareTo);
    }
}
