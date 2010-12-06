<?php

namespace Respect\Validation\Rules;

use Traversable;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

class Each extends AbstractRule
{

    protected $itemValidator;

    public function __construct(Validatable $itemValidator)
    {
        $this->itemValidator = $itemValidator;
    }

    public function validate($input)
    {
        if (!is_array($input) || $input instanceof Traversable)
            return false;
        foreach ($input as $item) {
            if (!$this->itemValidator->validate($item))
                return false;
        }
        return true;
    }

    protected function reportError($input, $item=null, array $related = array())
    {
        $e = $this->getException();
        if ($e)
            return $e;
        $e = $this->createException();
        $e->setRelated($related);
        $e->configure($input, $item, count($related));
        return $e;
    }

    public function assert($input)
    {
        if (!is_array($input) || $input instanceof Traversable)
            throw $this->reportError($input);
        $exceptions = array();
        foreach ($input as $item)
            try {
                $this->itemValidator->assert($item);
            } catch (ValidationException $e) {
                $exceptions[] = $e;
            }
        if (!empty($exceptions))
            throw $this->reportError($input, $item, $exceptions);
        return true;
    }

    public function check($input)
    {
        foreach ($input as $item)
            $this->itemValidator->check($item);
        return true;
    }

}