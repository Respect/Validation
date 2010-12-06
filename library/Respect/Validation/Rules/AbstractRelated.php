<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AllOf;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;
use \ReflectionProperty;
use \ReflectionException;

abstract class AbstractRelated extends AllOf
{
    const IS_OPTIONAL = false;
    protected $reference = '';

    public function __construct($reference, Validatable $referenceValidator=null)
    {
        if (!is_string($reference) || empty($reference))
            throw new ComponentException(
                'Invalid reference name'
            );
        $this->reference = $reference;
        if (!is_null($referenceValidator))
            $this->addRule($referenceValidator);
    }

    abstract protected function hasReference($input);

    abstract protected function getReferenceValue($input);

    protected function reportError($input, ValidationException $related=null)
    {
        $e = $this->getException();
        if ($e)
            return $e;
        $e = $this->createException();
        if (!is_null($related))
            $e->addRelated($related);
        $e->configure($input, $this->reference, !is_null($related));
        return $e;
    }

    public function validate($input)
    {
        if (!static::IS_OPTIONAL && !$this->hasReference($input))
            return false;
        return parent::validate($this->getReferenceValue($input));
    }

    public function assert($input)
    {
        if (!static::IS_OPTIONAL && !$this->hasReference($input))
            throw $this->reportError($input);
        try {
            parent::assert($this->getReferenceValue($input));
        } catch (ValidationException $e) {
            throw $this->reportError($input, $e);
        } catch (ReflectionException $e) {
            throw $this->reportError($input);
        }
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}