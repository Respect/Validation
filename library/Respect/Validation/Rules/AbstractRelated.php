<?php

namespace Respect\Validation\Rules;

use ReflectionProperty;
use ReflectionException;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractRelated extends AbstractRule implements Validatable
{

    protected $mandatory = true;
    protected $reference = '';
    protected $referenceValidator;

    abstract protected function hasReference($input);

    abstract protected function getReferenceValue($input);

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
            throw $this->reportError($input, array($e));
        } catch (ReflectionException $e) {
            throw $this->reportError($input);
        }
        return true;
    }

    public function check($input)
    {
        if ($this->mandatory && !$this->hasReference($input))
            throw $this->reportError($input);
        if (!is_null($this->referenceValidator))
            $this->referenceValidator->check(
                $this->getReferenceValue($input)
            );
        return true;
    }

    public function reportError($input, array $relatedExceptions=array())
    {
        return parent::reportError($input, $relatedExceptions, $this->reference,
            !is_null($relatedExceptions))->setId($this->reference);
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