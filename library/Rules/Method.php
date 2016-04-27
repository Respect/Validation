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

use ReflectionMethod;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

class Method extends AbstractRelated
{

    /**
     * An array of arguments that should be passed to the method.
     *
     * @var array
     */
    protected $methodArgs = [];

    public function __construct($reference, Validatable $validator = null, $mandatory = true, $methodArgs = [])
    {
        if(!is_string($reference) || empty($reference)) {
            throw new ComponentException('Invalid method name');
        }

        parent::__construct($reference, $validator, $mandatory);
    }

    public function getReferenceValue($input)
    {
        $methodMirror = new ReflectionMethod($input, $this->reference);
        $methodMirror->setAccessible(true);

        return $methodMirror->invokeArgs($input, $this->methodArgs);
    }

    public function hasReference($input)
    {
        return is_object($input) && method_exists($input, $this->reference);
    }
}
