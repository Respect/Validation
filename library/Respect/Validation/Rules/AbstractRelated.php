<?php

namespace Respect\Validation\Rules;

use ReflectionProperty;
use ReflectionException;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractRelated extends AbstractRule implements Validatable
{

    public $mandatory = true;
    public $reference = '';
    public $referenceValidator;

    abstract public function hasReference($input);

    abstract public function getReferenceValue($input);

    public function __construct($reference, Validatable $validator=null,
        $mandatory=true)
    {
        $this->reference = $reference;
        $this->referenceValidator = $validator;
        $this->mandatory = $mandatory;
    }

    public function assert($input)
    {
        if ($this->mandatory && !$this->hasReference($input))
            throw $this->reportError($input);
        try {
            if (!is_null($this->referenceValidator))
                $this->referenceValidator->assert(
                    $this->getReferenceValue($input)
                );
        } catch (ValidationException $e) {
            throw $this->reportError(
                $input, array('hasReference' => true)
            )->addRelated($e);
        } catch (ReflectionException $e) {
            if ($this->mandatory)
                throw $this->reportError(
                    $input, array('hasReference' => false)
                );
        }
        return true;
    }

    public function check($input)
    {
        if ($this->mandatory && !$this->hasReference($input))
            throw $this->reportError(
                $input,  array('hasReference' => false)
            );
        if (!is_null($this->referenceValidator))
            $this->referenceValidator->check(
                $this->getReferenceValue($input)
            );
        return true;
    }

    public function validate($input)
    {
        if ($this->mandatory && !$this->hasReference($input))
            return false;
        if (!is_null($this->referenceValidator))
            return $this->referenceValidator
                ->validate($this->getReferenceValue($input));
        return true;
    }

}
