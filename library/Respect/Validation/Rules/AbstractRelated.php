<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractRelated extends AbstractRule implements Validatable
{

    public $mandatory = true;
    public $reference = '';
    public $validator;

    abstract public function hasReference($input);

    abstract public function getReferenceValue($input);

    public function __construct($reference, Validatable $validator=null,
                                $mandatory=true)
    {
        $this->setName($reference);
        $this->reference = $reference;
        $this->validator = $validator;
        $this->mandatory = $mandatory;
    }

    public function assert($input)
    {
        $hasReference = $this->hasReference($input);

        if ($this->mandatory && !$hasReference)
            throw $this->reportError($input, array('hasReference' => false));
        elseif ((!$this->mandatory && !$hasReference) || !$this->validator)
            return true;

        try {
            return $this->validator->assert($this->getReferenceValue($input));
        } catch (ValidationException $e) {
            throw $this
                ->reportError($this->reference, array('hasReference' => true))
                ->addRelated($e);
        }
    }

    public function check($input)
    {
        $hasReference = $this->hasReference($input);

        if ($this->mandatory && !$hasReference)
            throw $this->reportError($input, array('hasReference' => false));
        elseif ((!$this->mandatory && !$hasReference) || !$this->validator)
            return true;

        return $this->validator->check($this->getReferenceValue($input));
    }

    public function validate($input)
    {
        $hasReference = $this->hasReference($input);

        if ($this->mandatory && !$hasReference)
            return false;
        elseif (!$this->mandatory && !$hasReference)
            return true;

        return is_null($this->validator)
        || $this->validator->validate($this->getReferenceValue($input));
    }

}
