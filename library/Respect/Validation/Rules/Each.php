<?php

namespace Respect\Validation\Rules;

use Traversable;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

class Each extends AbstractRule
{

    protected $itemValidator;

    public function __construct(Validatable $itemValidator = null,
        Validatable $keyValidator=null)
    {
        $this->itemValidator = $itemValidator;
        $this->keyValidator = $keyValidator;
    }

    public function validate($input)
    {
        if (empty($input))
            return true;
        if (!is_array($input) || $input instanceof Traversable)
            return false;
        foreach ($input as $key => $item) {
            if (isset($this->itemValidator) && !$this->itemValidator->validate($item))
                return false;
            if (isset($this->keyValidator) && !$this->keyValidator->validate($key))
                return false;
        }
        return true;
    }

    protected function reportError($input, $item=null, array $keys=array(),
        array $related = array())
    {
        $e = $this->getException();
        if ($e)
            return $e;
        $e = $this->createException();
        $e->setRelated($related);
        $e->configure($input, $item, implode(', ', $keys), count($related));
        return $e;
    }

    public function assert($input)
    {
        if (empty($input))
            return true;
        if (is_object($input))
            $input = get_object_vars($input);
        if (!is_array($input) || $input instanceof Traversable)
            throw $this->reportError($input);
        $exceptions = array();
        $keys = array();
        foreach ($input as $key => $item) {
            if (isset($this->itemValidator))
                try {
                    $this->itemValidator->assert($item);
                } catch (ValidationException $e) {
                    $exceptions[] = $e;
                    $keys[$key] = $key;
                }
            if (isset($this->keyValidator))
                try {
                    $this->keyValidator->assert($item);
                } catch (ValidationException $e) {
                    $exceptions[] = $e;
                    $keys[$key] = $key;
                }
        }
        if (!empty($exceptions))
            throw $this->reportError($input, $item, $keys, $exceptions);
        return true;
    }

    public function check($input)
    {
        foreach ($input as $item)
            $this->itemValidator->check($item);
        return true;
    }

}