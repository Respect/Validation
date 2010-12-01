<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\TraversableException;
use Respect\Validation\Validatable;
use \Traversable as Tvsable;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidException;

class Traversable extends AllOf
{

    protected $itemValidator;

    public function __construct(Validatable $itemValidator=null)
    {
        $this->itemValidator = $itemValidator;
    }

    protected function isTraversable($input)
    {
        return is_array($input) || $input instanceof Tvsable;
    }

    protected function buildException($input)
    {
        return new TraversableException($input);
    }

    public function validate($input)
    {
        if (!$this->isTraversable($input))
            return false;
        if (!is_null($this->itemValidator))
            foreach ($input as $item)
                if (!$this->itemValidator->validate($item))
                    return false;
        return true;
    }

    public function assert($input)
    {
        $exceptions = array();
        if (!$this->isTraversable($input))
            $exceptions[] = $this->buildException($input);
        if (!is_null($this->itemValidator))
            foreach ($input as $item)
                try {
                    $this->itemValidator->assert($item);
                } catch (InvalidException $e) {
                    $exceptions[] = $e;
                }
        if (!empty($exceptions))
            throw $this->buildException($exceptions);
        return true;
    }

    public function check($input)
    {
        if (!$this->isTraversable($input))
            throw $this->buildException($exceptions);
        if (!is_null($this->itemValidator))
            foreach ($input as $item)
                if (!$this->itemValidator->check($item))
                    return false;
        return true;
    }

}