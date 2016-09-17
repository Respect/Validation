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

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;

abstract class AbstractRelated extends AbstractRule
{
    public $mandatory = true;
    public $reference = '';
    public $validator;

    abstract public function hasReference($input);

    abstract public function getReferenceValue($input);

    public function __construct($reference, Validatable $validator = null, $mandatory = true)
    {
        $this->setName($reference);
        if ($validator && !$validator->getName()) {
            $validator->setName($reference);
        }

        $this->reference = $reference;
        $this->validator = $validator;
        $this->mandatory = $mandatory;
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
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input, ['hasReference' => false]);
        }

        try {
            return $this->decision('assert', $hasReference, $input);
        } catch (ValidationException $e) {
            throw $this
                ->reportError($this->reference, ['hasReference' => true])
                ->addRelated($e);
        }
    }

    public function check($input)
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            throw $this->reportError($input, ['hasReference' => false]);
        }

        return $this->decision('check', $hasReference, $input);
    }

    public function validate($input)
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference) {
            return false;
        }

        return $this->decision('validate', $hasReference, $input);
    }
}
