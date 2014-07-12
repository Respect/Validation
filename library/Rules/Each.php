<?php
namespace Respect\Validation\Rules;

use Traversable;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

class Each extends AbstractRule
{
    public $itemValidator;
    public $keyValidator;

    public function __construct(Validatable $itemValidator = null,
                                Validatable $keyValidator=null)
    {
        $this->itemValidator = $itemValidator;
        $this->keyValidator = $keyValidator;
    }

    public function assert($input)
    {
        $exceptions = array();

        if (!is_array($input) || $input instanceof Traversable) {
            throw $this->reportError($input);
        }

        if (empty($input)) {
            return true;
        }

        foreach ($input as $key => $item) {
            if (isset($this->itemValidator)) {
                try {
                    $this->itemValidator->assert($item);
                } catch (ValidationException $e) {
                    $exceptions[] = $e;
                }
            }

            if (isset($this->keyValidator)) {
                try {
                    $this->keyValidator->assert($key);
                } catch (ValidationException $e) {
                    $exceptions[] = $e;
                }
            }
        }

        if (!empty($exceptions)) {
            throw $this->reportError($input)->setRelated($exceptions);
        }

        return true;
    }

    public function check($input)
    {
        if (empty($input)) {
            return true;
        }

        if (!is_array($input) || $input instanceof Traversable) {
            throw $this->reportError($input);
        }

        foreach ($input as $key => $item) {
            if (isset($this->itemValidator)) {
                $this->itemValidator->check($item);
            }

            if (isset($this->keyValidator)) {
                $this->keyValidator->check($key);
            }
        }

        return true;
    }

    public function validate($input)
    {
        if (!is_array($input) || $input instanceof Traversable) {
            return false;
        }

        if (empty($input)) {
            return true;
        }

        foreach ($input as $key => $item) {
            if (isset($this->itemValidator) && !$this->itemValidator->validate($item)) {
                return false;
            }

            if (isset($this->keyValidator) && !$this->keyValidator->validate($key)) {
                return false;
            }
        }

        return true;
    }
}

