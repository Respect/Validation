<?php

namespace Respect\Validation\Rules;

use Traversable;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

class Each extends AbstractRule
{

    public $itemValidator;
    public $keyValidator;

    public function __construct(Validatable $itemValidator = null, Validatable $keyValidator=null)
    {
        $this->itemValidator = $itemValidator;
        $this->keyValidator = $keyValidator;
    }

    public function assert($input)
    {
        $exceptions = array();

        if (empty($input))
            return true;
        elseif (is_object($input))
            $input = get_object_vars($input);
        elseif (!is_array($input) || $input instanceof Traversable)
            throw $this->reportError($input);
        else
            foreach ($input as $key => $item)
                if (isset($this->itemValidator))
                    try {
                        $this->itemValidator->assert($item);
                    } catch (ValidationException $e) {
                        $exceptions[] = $e;
                    }
                elseif (isset($this->keyValidator))
                    try {
                        $this->keyValidator->assert($item);
                    } catch (ValidationException $e) {
                        $exceptions[] = $e;
                    }

        if (!empty($exceptions))
            throw $this->reportError($input)->setRelated($exceptions);

        return true;
    }

    public function check($input)
    {
        foreach ($input as $item)
            if (isset($this->itemValidator))
                $this->itemValidator->check($item);
            elseif (isset($this->keyValidator))
                $this->keyValidator->check($item);

        return true;
    }

    public function validate($input)
    {
        if (empty($input))
            return true;
        elseif (!is_array($input) || $input instanceof Traversable)
            return false;
        else
            foreach ($input as $key => $item)
                if (isset($this->itemValidator) && !$this->itemValidator->validate($item))
                    return false;
                elseif (isset($this->keyValidator) && !$this->keyValidator->validate($key))
                    return false;

        return true;
    }

}
