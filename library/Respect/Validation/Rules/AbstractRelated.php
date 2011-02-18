<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\AbstractCompositeException;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractRelated extends AbstractRule implements Validatable
{

    public $mandatory = true;
    public $reference = '';
    public $validator;

    abstract public function hasReference($input);

    abstract public function getReferenceValue($input);

    public function __construct($reference, Validatable $validator=null, $mandatory=true)
    {
        $this->reference = $reference;
        $this->validator = $validator;
        $this->mandatory = $mandatory;
    }

    public function assert($input)
    {
        if (!$this->verifyMandatory($input))
            throw $this->reportError($input, array('hasReference' => false));
        elseif (!$this->validator)
            return true;
        else
            try {
                return $this->validator->assert($this->getReferenceValue($input));
            } catch (ValidationException $e) {
                throw $this
                    ->reportError($this->reference, array('hasReference' => true))
                    ->setName($this->reference)
                    ->addRelated($e);
            }
    }

    public function check($input)
    {
        if (!$this->verifyMandatory($input))
            throw $this->reportError($input, array('hasReference' => false));
        else
            return $this->validator->check($this->getReferenceValue($input));
    }

    public function validate($input)
    {
        if (!$this->verifyMandatory($input))
            return false;
        else
            return $this->validator->validate($this->getReferenceValue($input));
    }

    protected function verifyMandatory($input)
    {
        return!$this->mandatory || $this->hasReference($input);
    }

}
