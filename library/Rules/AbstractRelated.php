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

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractRelated extends AbstractRule
{
    public $mandatory = true;
    public $reference = '';
    public $validator;

    abstract public function hasReference($input);

    abstract public function getReferenceValue($input);

    public function __construct($reference, Validatable $validator = null, $mandatory = true)
    {
        $this->reference = $reference;
        $this->validator = $validator;
        $this->mandatory = $mandatory;

        $this->setName($reference);
    }

    public function setName($name)
    {
        parent::setName($name);

        if ($this->validator instanceof Validatable) {
            $this->validator->setName($name);
        }

        return $this;
    }

    private function decision($type, $hasReference, $input)
    {
        return (!$this->mandatory && !$hasReference)
            || (is_null($this->validator)
                || $this->validator->$type($this->getReferenceValue($input)));
    }

    public function assert($input)
    {
        if ($input === '') {
            return true;
        }

        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input, array('hasReference' => false));
        }

        try {
            return $this->decision('assert', $hasReference, $input);
        } catch (ValidationException $e) {
            throw $this
                ->reportError($this->reference, array('hasReference' => true))
                ->addRelated($e);
        }
    }

    public function check($input)
    {
        if ($input === '') {
            return true;
        }

        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input, array('hasReference' => false));
        }

        return $this->decision('check', $hasReference, $input);
    }

    public function validate($input)
    {
        if ($input === '') {
            return true;
        }

        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            return false;
        }

        return $this->decision('validate', $hasReference, $input);
    }
}
