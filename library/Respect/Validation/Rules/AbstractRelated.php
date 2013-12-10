<?php
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

    public function __construct($reference, Validatable $validator=null,
                                $mandatory=true)
    {
        $this->setName($reference);
        $this->reference = $reference;
        $this->validator = $validator;
        $this->mandatory = $mandatory;
    }

    private function decision($type, $hasReference, $input) {
        return (!$this->mandatory && !$hasReference)
            || (is_null($this->validator)
                || $this->validator->$type($this->getReferenceValue($input)));
    }

    public function assert($input)
    {
        if ($input === '')
            return true;

        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference)
            throw $this->reportError($input, array('hasReference' => false));

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
        if ($input === '')
            return true;

        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference)
            throw $this->reportError($input, array('hasReference' => false));
        return $this->decision('check', $hasReference, $input);
    }

    public function validate($input)
    {
        $hasReference = $this->hasReference($input);
        if ($this->mandatory && !$hasReference)
            return false;
        return $this->decision('validate', $hasReference, $input);
    }
}

